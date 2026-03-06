<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use App\User;

class PasswordResetController extends Controller
{
    public function showResetForm(Request $request)
    {
        $token = $request->query('token');
        $email = $request->query('email');

        if (!$token || !$email) {
            return redirect('/')->with('error', 'Invalid reset link.');
        }

        // Check if user exists and token is valid
        $user = User::where('email', $email)
            ->where('reset_token', $token)
            ->first();

        if (!$user) {
            return redirect('/')->with('error', 'Invalid reset token.');
        }

        if (Carbon::now()->isAfter($user->reset_token_expires_at)) {
            return redirect('/')->with('error', 'Reset token has expired. Please request a new one.');
        }

        return view('frontend.reset-password', compact('token', 'email'));
    }

    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Find user and verify token
        $user = User::where('email', $request->email)
            ->where('reset_token', $request->token)
            ->first();

        if (!$user) {
            return back()->with('error', 'Invalid reset token.');
        }

        // Check if token has expired
        if (Carbon::now()->isAfter($user->reset_token_expires_at)) {
            return back()->with('error', 'Reset token has expired. Please request a new one.');
        }

        // Update password and clear reset token
        $user->update([
            'password' => Hash::make($request->password),
            'reset_token' => null,
            'reset_token_expires_at' => null,
        ]);

        return redirect('/')->with('success', 'Password has been reset successfully. You can now log in with your new password.');
    }
}