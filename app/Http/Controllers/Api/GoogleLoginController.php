<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GoogleLoginController extends Controller
{
    /**
     * Mobile/API Google Sign-In.
     * Expects a Google ID token (from Google One-Tap / OAuth for mobile).
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_token' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation failed',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $tokenInfo = $this->verifyIdToken($request->input('id_token'));

        if (!$tokenInfo) {
            return response()->json([
                'status'  => false,
                'message' => 'Invalid or expired Google token.',
            ], 401);
        }

        $googleId = $tokenInfo['sub'];
        $email = ($tokenInfo['email_verified'] ?? 'false') === 'true'
            ? ($tokenInfo['email'] ?? null)
            : null;
        $name = $tokenInfo['name'] ?? $tokenInfo['given_name'] ?? 'Google User';

        if (!$email) {
            $email = sprintf('%s@google-anonymous.local', $googleId);
        }

        try {
            $user = User::where('google_id', $googleId)
                ->orWhere('email', $email)
                ->first();

            if ($user) {
                if (empty($user->google_id)) {
                    $user->google_id = $googleId;
                }

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
                    'google_id'=> $googleId,
                    'password' => bcrypt(Str::random(32)),
                    'profile_completed' => false,
                ]);
            }

            // Issue fresh Sanctum token (optionally keep old ones if desired)
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
            Log::error('Google login failed', ['message' => $e->getMessage()]);

            return response()->json([
                'status'  => false,
                'message' => 'Unable to complete Google login right now.',
            ], 500);
        }
    }

    /**
     * Verify Google ID token via Google's tokeninfo endpoint.
     */
    private function verifyIdToken(string $idToken): ?array
    {
        $client = new Client([
            'base_uri' => 'https://oauth2.googleapis.com',
            'timeout'  => 5,
        ]);

        try {
            $response = $client->get('/tokeninfo', [
                'query' => ['id_token' => $idToken],
            ]);

            if ($response->getStatusCode() !== 200) {
                return null;
            }

            $data = json_decode($response->getBody()->getContents(), true);

            $aud = env('GOOGLE_CLIENT_ID');
            if (!$aud || ($data['aud'] ?? null) !== $aud) {
                return null;
            }

            // exp is in seconds since epoch
            if (isset($data['exp']) && (int)$data['exp'] < time()) {
                return null;
            }

            // Accept issuer from either variant
            $issuer = $data['iss'] ?? '';
            if (!in_array($issuer, ['accounts.google.com', 'https://accounts.google.com'], true)) {
                return null;
            }

            return $data;
        } catch (\Throwable $e) {
            Log::warning('Failed to verify Google id_token: ' . $e->getMessage());
            return null;
        }
    }

    private function shouldUpdateEmail(?string $current, string $incoming): bool
    {
        if (!$incoming) {
            return false;
        }

        if (!$current) {
            return true;
        }

        $isPlaceholder = str_ends_with($current, '@google-anonymous.local');

        return $isPlaceholder && $current !== $incoming;
    }
}
