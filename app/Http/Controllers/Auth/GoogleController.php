<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')
                ->stateless()
                ->user();
            } catch (\Exception $e) {

            Log::channel('daily')->error('Google Login Error', [
                'error' => $e->getMessage()
            ]);

            return redirect('/login')->with(
                'error',
                $e->getMessage()
            );
        }

        $user = User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            if (empty($user->google_id)) {
                $user->update([
                    'google_id' => $googleUser->getId(),
                ]);
            }

        } else {
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'password' => bcrypt(Str::random(16)),
                'profile_completed' => false,
            ]);

            try {
                if (filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
                    $emailData = [
                        'name'  => $user->name,
                        'email' => $user->email,
                    ];

                    Mail::mailer('gmail2')->send(
                        'frontend.emails.welcome_user',
                        $emailData,
                        function ($message) use ($user) {
                            $message->to($user->email)
                                ->from('smartg5automation@gmail.com', 'Smart 5G Automation')
                                ->subject('Welcome to SMARTHOME GROUP - Your Account Has Been Created!');
                        }
                    );
                }
            } catch (\Exception $e) {
                Log::error('Failed to send Google welcome email to ' . $user->email . ': ' . $e->getMessage());
            }
        }

        Auth::login($user, true);

        if (!$user->profile_completed) {
            return redirect()->route('complete.profile');
        }

        return redirect('/');
    }
}
