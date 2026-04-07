<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| API Routes for React Frontend
|-------------------------------------------------------------------------- 
*/

Route::prefix('api')->group(function () {
    // Keep all existing API endpoints
    Route::post('/newsletter/store', [\App\Http\Controllers\NewsletterController::class, 'newsletterStore'])->name('newsletter.store');
    Route::post('/get-cities', [\App\Http\Controllers\PropertyController::class, 'getCities'])->name('get.cities');
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

// SPA Catch-all route for React Router
Route::get('/{any}', function () {
    return file_get_contents(public_path('build/index.html'));
})->where('any', '.*');

/*
 * Admin routes stay the same
 */
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => 'auth:admin'
], function () {
    // Existing admin routes...
});
