<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'required|string|min:10|max:15|unique:users,phone',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            // return the validation messages so the client knows exactly what
            // went wrong; the previous generic message made it hard to
            // diagnose issues.
            return response()->json([
                'status'  => false,
                'message' => 'Validation failed',
                'errors'  => $validator->errors(),
            ], 422);
        }

        // create the user; wrap in a try/catch in case the save fails
        // (duplicate key, database issue etc) so we can return a clear
        // response instead of a 500 error.
        try {
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'phone'    => $request->phone,
                'password' => Hash::make($request->password),
            ]);
        } catch (\Exception $e) {
            // log the exception and send a friendly error message back to
            // the client. 422 is appropriate if the data itself caused the
            // failure, otherwise 500 for server issues.
            Log::error('User creation failed: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Registration failed due to server error.',
            ], 500);
        }

        // Create API token (Laravel Sanctum)
        $token = $user->createToken('campus-direct-app')->plainTextToken;

        // Optional: Send welcome email
        try {
            Mail::mailer('gmail2')->send(
                'frontend.emails.welcome_user',
                ['name' => $user->name],
                function ($message) use ($user) {
                    $message->to($user->email)
                        ->subject('Welcome to Campus Direct');
                }
            );
        } catch (\Exception $e) {
            Log::error('Welcome mail failed: ' . $e->getMessage());
        }

        return response()->json([
            'status' => true,
            'message' => 'Registration successful',
            'token' => $token,
            'user' => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
            ]
        ], 201);
    }

    public function login(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'login'    => 'required|string', // email OR phone
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Login failed. Please check your details.',
            ], 422);
        }

        // Detect email or phone
        $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'phone';

        // Find user
        $user = \App\User::where($fieldType, $request->login)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status'  => false,
                'message' => 'Login failed. Please check your credentials.',
            ], 401);
        }

        // Revoke old tokens (optional but recommended)
        $user->tokens()->delete();

        // Create new token
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
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logged out successfully',
        ]);
    }

    public function forgotPassword(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation failed',
                'errors'  => $validator->errors(),
            ], 422);
        }

        try {
            // Find user by email
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                // For security, return same message whether user exists or not
                return response()->json([
                    'status' => true,
                    'message' => 'If an account exists with this email, you will receive a password reset link.',
                ], 200);
            }

            // Generate reset token
            $resetToken = Str::random(64);
            
            // Store reset token and expiration time (valid for 24 hours)
            $user->update([
                'reset_token' => $resetToken,
                'reset_token_expires_at' => Carbon::now()->addHours(24),
            ]);

            // Build reset URL - adjust the URL based on your frontend domain
            $resetUrl = "https://laganlakshmiinfra.com/reset-password?token={$resetToken}&email={$user->email}";
            
            // Send password reset email
            try {
                Mail::mailer('gmail2')->send(
                    'frontend.emails.password_reset',
                    [
                        'name' => $user->name,
                        'email' => $user->email,
                        'resetUrl' => $resetUrl,
                        'resetToken' => $resetToken,
                    ],
                    function ($message) use ($user) {
                        $message->to($user->email)
                            ->subject('Password Reset Request - Lagan Lakshmi Infra');
                    }
                );
            } catch (\Exception $e) {
                Log::error('Password reset email failed: ' . $e->getMessage());
                // Even if email fails, we still want to return success to user
            }

            return response()->json([
                'status' => true,
                'message' => 'Password reset link has been sent to your email. Please check your inbox.',
            ], 200);

        } catch (\Exception $e) {
            Log::error('Forgot Password error: ' . $e->getMessage());
            
            return response()->json([
                'status' => false,
                'message' => 'An error occurred. Please try again later.',
            ], 500);
        }
    }

    public function resetPassword(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'token'    => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation failed',
                'errors'  => $validator->errors(),
            ], 422);
        }

        try {
            // Find user and verify token
            $user = User::where('email', $request->email)
                ->where('reset_token', $request->token)
                ->first();

            if (!$user) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Invalid reset token.',
                ], 401);
            }

            // Check if token has expired
            if (Carbon::now()->isAfter($user->reset_token_expires_at)) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Reset token has expired. Please request a new one.',
                ], 401);
            }

            // Update password and clear reset token
            $user->update([
                'password' => Hash::make($request->password),
                'reset_token' => null,
                'reset_token_expires_at' => null,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Password has been reset successfully.',
            ], 200);

        } catch (\Exception $e) {
            Log::error('Reset Password error: ' . $e->getMessage());
            
            return response()->json([
                'status' => false,
                'message' => 'An error occurred. Please try again later.',
            ], 500);
        }
    }
}
