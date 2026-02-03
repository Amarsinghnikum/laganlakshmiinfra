<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Admin;
use App\Models\AdminLogin;
use App\Models\UserLogin;
use App\User;
use Illuminate\Support\Str;
use DB,Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN_DASHBOARD;

    /**
     * show login form for admin guard
     *
     * @return void
     */
    public function showLoginForm()
    {
        return view('backend.auth.login');
    }


    /**
     * login admin
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('web')->attempt($credentials, $request->filled('remember'))) {
            $user = Auth::guard('web')->user();

            UserLogin::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'ip_address' => $request->ip(),
                    'login_time' => now(),
                ]
            );

            return redirect()->intended('/');
        }

        return back()->with('error', 'Invalid email or password.');
    }

    public function AdminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:50',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], $request->filled('remember'))) {

            $user = Auth::guard('admin')->user();

            AdminLogin::updateOrCreate(
                ['admin_id' => $user->id],
                [
                    'ip_address' => $request->ip(),
                    'login_time' => now(),
                ]
            );

            return redirect()->intended('/admin');
        }

        return back()->with('error', 'Invalid email or password.');
    }

    /**
     * logout admin guard
     *
     * @return void
     */

    public function logout()
    {
        $user = Auth::guard('admin')->user();
        Auth::guard('admin')->logout();
    
        return redirect()->route('login');
    }     
}