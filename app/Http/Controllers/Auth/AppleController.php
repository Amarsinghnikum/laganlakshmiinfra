<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AppleController extends Controller
{
    /**
     * Handle Sign in with Apple for mobile/API clients.
     * Expects the Apple `identity_token` (JWT), plus optional name/email when Apple shares them once.
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identity_token' => 'required|string',
            'email'          => 'nullable|email',
            'name'           => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation failed',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $rawToken = $request->input('identity_token');
        $payload = $this->verifyIdentityToken($rawToken);

        if (!$payload || empty($payload['sub'])) {
            return response()->json([
                'status'  => false,
                'message' => 'Invalid or expired Apple identity token.',
            ], 401);
        }

        $appleId = $payload['sub'];
        $email = ($payload['email_verified'] ?? 'false') === 'true'
            ? ($payload['email'] ?? $request->input('email'))
            : $request->input('email');
        $name = $request->input('name')
            ?? ($payload['name']['firstName'] ?? null)
            ?? 'Apple User';

        // If Apple hides email, create a stable placeholder to satisfy unique/email constraints
        if (!$email) {
            $email = sprintf('%s@apple-anonymous.local', $appleId);
        }

        try {
            $user = User::where('apple_id', $appleId)
                ->orWhere('email', $email)
                ->first();

            if ($user) {
                // Attach apple_id if this existing user signs in via Apple later
                if (empty($user->apple_id)) {
                    $user->apple_id = $appleId;
                }

                // Fill email when the anonymous placeholder can be replaced by a real email
                if ($this->shouldUpdateEmail($user->email, $email)) {
                    $user->email = $email;
                }

                if ($name && empty($user->name)) {
                    $user->name = $name;
                }

                $user->save();
            } else {
                $user = User::create([
                    'name'     => $name,
                    'email'    => $email,
                    'apple_id' => $appleId,
                    'password' => bcrypt(Str::random(32)),
                    'profile_completed' => false,
                ]);
            }

            // One token per device/session (clean older ones)
            $user->tokens()->delete();
            $token = $user->createToken('campus-direct-app')->plainTextToken;

            return response()->json([
                'status'  => true,
                'message' => 'Login successful',
                'token'   => $token,
                'user'    => [
                    'id'    => $user->id,
                    'name'  => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                ],
            ], 200);
        } catch (\Exception $e) {
            Log::error('Apple login failed', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'status'  => false,
                'message' => 'Unable to complete Apple login right now.',
            ], 500);
        }
    }

    /**
     * Verify the Apple identity token:
     *  - signature using Apple's JWKS
     *  - issuer, audience, expiry
     * Returns decoded payload on success, null on failure.
     */
    private function verifyIdentityToken(string $jwt): ?array
    {
        $parts = explode('.', $jwt);
        if (count($parts) < 3) {
            return null;
        }

        [$headerB64, $payloadB64, $signatureB64] = $parts;
        $header = json_decode($this->base64UrlDecode($headerB64) ?? '', true);
        $payload = json_decode($this->base64UrlDecode($payloadB64) ?? '', true);

        if (!$header || !$payload || !isset($header['kid'])) {
            return null;
        }

        $aud = env('APPLE_CLIENT_ID');
        if (!$aud || ($payload['aud'] ?? null) !== $aud) {
            return null;
        }

        if (($payload['iss'] ?? null) !== 'https://appleid.apple.com') {
            return null;
        }

        $now = time();
        if (($payload['exp'] ?? 0) < $now || ($payload['iat'] ?? 0) > $now + 300) {
            return null;
        }

        $publicKey = $this->getApplePublicKey($header['kid'], $header['alg'] ?? 'RS256');
        if (!$publicKey) {
            return null;
        }

        $dataToVerify = $headerB64 . '.' . $payloadB64;
        $signature = $this->base64UrlDecode($signatureB64);

        $ok = openssl_verify($dataToVerify, $signature, $publicKey, OPENSSL_ALGO_SHA256) === 1;

        return $ok ? $payload : null;
    }

    private function base64UrlDecode(string $data): ?string
    {
        $remainder = strlen($data) % 4;
        if ($remainder) {
            $data .= str_repeat('=', 4 - $remainder);
        }

        $decoded = base64_decode(strtr($data, '-_', '+/'), true);

        return $decoded === false ? null : $decoded;
    }

    private function shouldUpdateEmail(?string $current, string $incoming): bool
    {
        if (!$incoming) {
            return false;
        }

        if (!$current) {
            return true;
        }

        // Replace the placeholder email with a real one if we get it later
        $isPlaceholder = str_ends_with($current, '@apple-anonymous.local');

        return $isPlaceholder && $current !== $incoming;
    }

    private function getApplePublicKey(string $kid, string $alg): ?string
    {
        $jwks = Cache::remember('apple_jwks', 60 * 24, function () {
            try {
                $client = new \GuzzleHttp\Client([
                    'base_uri' => 'https://appleid.apple.com',
                    'timeout'  => 5,
                ]);
                $response = $client->get('/auth/keys');
                if ($response->getStatusCode() !== 200) {
                    return null;
                }

                return json_decode($response->getBody()->getContents(), true);
            } catch (\Throwable $e) {
                Log::warning('Failed to fetch Apple JWKS: ' . $e->getMessage());
                return null;
            }
        });

        if (!isset($jwks['keys']) || !is_array($jwks['keys'])) {
            return null;
        }

        foreach ($jwks['keys'] as $jwk) {
            if (($jwk['kid'] ?? null) === $kid && ($jwk['alg'] ?? null) === $alg) {
                return $this->jwkToPem($jwk);
            }
        }

        return null;
    }

    private function jwkToPem(array $jwk): ?string
    {
        if (!isset($jwk['n'], $jwk['e'])) {
            return null;
        }

        $modulus = $this->base64UrlDecode($jwk['n']);
        $exponent = $this->base64UrlDecode($jwk['e']);

        if (!$modulus || !$exponent) {
            return null;
        }

        // Build the RSA public key in PEM format
        $components = [
            'modulus' => $modulus,
            'publicExponent' => $exponent,
        ];

        $rsa = [
            'n' => $this->encodeDERInteger($components['modulus']),
            'e' => $this->encodeDERInteger($components['publicExponent']),
        ];

        $sequence = $this->encodeDERSequence($rsa['n'] . $rsa['e']);
        $bitString = "\x03" . $this->encodeDERLength(strlen($sequence) + 1) . "\x00" . $sequence;

        $rsaOID = "\x30\x0D\x06\x09\x2A\x86\x48\x86\xF7\x0D\x01\x01\x01\x05\x00";
        $subjectPublicKeyInfo = "\x30" . $this->encodeDERLength(strlen($rsaOID . $bitString)) . $rsaOID . $bitString;

        $pem = "-----BEGIN PUBLIC KEY-----\n" .
            chunk_split(base64_encode($subjectPublicKeyInfo), 64, "\n") .
            "-----END PUBLIC KEY-----";

        return $pem;
    }

    private function encodeDERInteger(string $value): string
    {
        // prepend zero if high bit is set
        if (ord($value[0]) > 0x7f) {
            $value = "\x00" . $value;
        }
        return "\x02" . $this->encodeDERLength(strlen($value)) . $value;
    }

    private function encodeDERSequence(string $value): string
    {
        return "\x30" . $this->encodeDERLength(strlen($value)) . $value;
    }

    private function encodeDERLength(int $length): string
    {
        if ($length <= 0x7f) {
            return chr($length);
        }

        $temp = ltrim(pack('N', $length), "\x00");
        return chr(0x80 | strlen($temp)) . $temp;
    }
}
