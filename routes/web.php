<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Backend\AdminsController;
use App\Http\Controllers\Backend\Auth\ForgotPasswordController;
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\RolesController;
use App\Http\Controllers\Backend\CityController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\Backend\PropertyController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ContactController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

/**
    * Frontend routes
*/
Route::get('/', [FrontendController::class, 'home'])->middleware('track');
Route::post('/login', [LoginController::class, 'login'])->name('user.login.submit');
Route::get('/clear-cache', function () {
    Artisan::call('optimize');
    return "Application cache cleared and optimized!";
});

Route::get('/sitemap.xml', function () {
    return response()->file(public_path('sitemap.xml'), [
        'Content-Type' => 'application/xml'
    ]);
});

Route::get('/robots.txt', function () {
    return response()->file(public_path('robots.txt'), [
        'Content-Type' => 'text/plain',
    ]);
});

Route::middleware(['track'])->group(function () {

    Route::get('/', 'HomeController@redirectAdmin')->name('index');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/', function () {
        return view('home.home');
    });

    // Home
    Route::get('/', [FrontendController::class, 'index']);
    Route::get('/contact-us', [FrontendController::class, 'contact'])->name('contact');
    Route::get('/properties', [FrontendController::class, 'properties'])->name('properties');
    Route::get('/property-details', [FrontendController::class, 'propertyDetails'])->name('property.details');
    Route::post('/contact-submit', [ContactController::class, 'submit'])->name('contact.submit');
    Route::get('/about', [FrontendController::class, 'about'])->name('about');
});

Route::post('/newsletter/store', [NewsletterController::class, 'newsletterStore'])->name('newsletter.store');

// Property
Route::resource('properties', PropertyController::class);

/**
* Admin routes
*/
Route::get('admin/login/form/', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::redirect('/admin/login', '/admin/login/form');
Route::post('admin/logins', [LoginController::class, 'AdminLogin']);

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => 'auth:admin'
], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/save-dashboard-data', [DashboardController::class, 'savedashboarddata'])->name('savedashboarddata');
    Route::resource('roles', RolesController::class);
    Route::resource('admins', AdminsController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('propertytype', PropertyTypeController::class);
    Route::post('/get-property-types', [PropertyController::class, 'getPropertytypes']);

    Route::get('/states', [CityController::class, 'states'])->name('states.index');
    Route::get('/cities', [CityController::class, 'cities'])->name('cities.index');

    Route::get('/contacts', [DashboardController::class, 'Queries'])->name('query.index');
    Route::delete('contact/{id}', [DashboardController::class, 'destroy'])->name('query.destroy');

    // Login Routes.
   
    Route::post('/login/submit', [LoginController::class, 'login'])->name('login.submit');

    // Logout Routes.
    Route::post('/logout/submit', [LoginController::class, 'logout'])->name('logout.submit');

    // Forget Password Routes.
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/reset/submit', [ForgotPasswordController::class, 'reset'])->name('password.update');
})->middleware('auth:admin');