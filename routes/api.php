<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Backend\PropertyController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register'])->withoutMiddleware('throttle');
Route::post('/login', [AuthController::class, 'login'])->withoutMiddleware('throttle');

// Cities and States API Routes
Route::get('/states', [LocationController::class, 'getStates']);
Route::get('/states/{id}', [LocationController::class, 'getState']);
Route::get('/states/{id}/cities', [LocationController::class, 'getCitiesByState']);
Route::get('/cities', [LocationController::class, 'getCities']);
Route::get('/cities/{id}', [LocationController::class, 'getCity']);

// Property Types API Routes
Route::get('/property-types', [LocationController::class, 'getPropertyTypes']);
Route::get('/property-types/{id}', [LocationController::class, 'getPropertyType']);

Route::middleware('auth:sanctum')->withoutMiddleware('throttle')->group(function () {

    Route::get('/profile', function (Request $request) {
        return response()->json([
            'status' => true,
            'user' => $request->user()
        ]);
    });

    Route::post('/properties', [PropertyController::class, 'propertyStore']);
    Route::post('/logout', [AuthController::class, 'logout']);
});