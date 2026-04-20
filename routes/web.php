<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Auth\LoginController as UserLoginController;
use App\Http\Controllers\Auth\RegisterController as UserRegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Backend\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PropertyController;

/*
|--------------------------------------------------------------------------
| API Routes for React Frontend
|-------------------------------------------------------------------------- 
*/

Route::prefix('api')->group(function () {
    // Keep all existing API endpoints
    Route::post('/newsletter/store', [\App\Http\Controllers\NewsletterController::class, 'newsletterStore'])->name('newsletter.store');
    Route::post('/get-cities', [PropertyController::class, 'getCities'])->name('get.cities');
    // Add other API routes...
});

// Lightweight proxy to avoid CORS when frontend (http://127.0.0.1:8000) calls the public API
Route::get('/proxy/featured-listings', function () {
    $response = Http::timeout(10)
        ->acceptJson()
        ->get('https://laganlakshmiinfra.com/api/listings/featured');

    // Try to forward JSON if possible; fall back to raw body
    if ($response->ok()) {
        $json = $response->json();
        if ($json !== null) {
            return response()
                ->json($json, $response->status())
                ->withHeaders(['Access-Control-Allow-Origin' => '*']);
        }
    }

    return response($response->body(), $response->status())
        ->withHeaders([
            'Content-Type' => $response->header('Content-Type', 'text/plain'),
            'Access-Control-Allow-Origin' => '*',
        ]);
});

// Public auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserLoginController::class, 'login'])->name('login.submit');
    Route::get('/register', [UserRegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [UserRegisterController::class, 'register']);
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
    Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
    Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
});

Route::post('/logout', [UserLoginController::class, 'logout'])->name('logout');

// Admin auth routes
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/logins', [AdminLoginController::class, 'AdminLogin'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

// SPA Catch-all route for React Router
// Only catch requests that don't match real files or static assets
Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '^(?!static/)(?!build/)(?!api/)(?!admin/)(?!\.well-known).*$')
  ->name('welcome');

/*
 * Admin routes stay the same
 */
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => 'auth:admin'
], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Existing admin routes...
});
