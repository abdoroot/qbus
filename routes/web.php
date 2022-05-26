<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return "all is cleared";
});
// Set Locale Route
Route::get('setlocale/{locale}', 'HomeController@setLocale')->name('localization');
Route::get('about', 'HomeController@about')->name('about');
Route::get('services', 'HomeController@services')->name('services');
Route::get('contact', 'HomeController@contact')->name('contact');
Route::post('email', 'HomeController@email')->name('email');
Route::get('code', 'HomeController@code')->name('code');

Route::namespace('\App\Http\Controllers\User')->group(function() {

    Route::resource('trips', 'TripController')->only('index', 'show');
    Route::resource('packages', 'PackageController')->only('index', 'show');

    Route::post('trips/review', 'TripController@review')->name('trips.review');
    Route::post('packages/review', 'PackageController@review')->name('packages.review');

    Route::middleware(['auth'])->group(function() {
        //Route::get('/home', function (){ return redirect(route('home'));})->name('dashboard');
        Route::get('/home', 'HomeController@index')->name('dashboard');
        Route::get('/profile', 'ProfileController@index')->name('profile.index');
        Route::get('/profile/settings', 'ProfileController@settings')->name('profile.shows.settings');
        Route::post('/profile', 'ProfileController@update')->name('profile.settings');
        Route::post('/password', 'ProfileController@password')->name('profile.password');
        Route::get('/profile/logout', 'ProfileController@logout')->name('profile.logout');

        Route::resource('contacts', 'ContactController')->only('index', 'show', 'create', 'store');
        Route::resource('notifications', 'NotificationController')->only('index', 'show', 'update', 'destroy');

        // bus Orders
        Route::get('busOrders/{id}/payment', 'BusOrderController@payment')->name('busOrders.payment');
        Route::resource('busOrders', 'BusOrderController');

        // make a trip order
        Route::resource('tripOrders', 'TripOrderController');
        // payment link for the trip order
        Route::get('tripOrders/{id}/payment', 'TripOrderController@payment')->name('tripOrders.payment');

        // package Orders
        Route::get('packageOrders/{id}/payment', 'PackageOrderController@payment')->name('packageOrders.payment');
        Route::resource('packageOrders', 'PackageOrderController');
    });
});

Auth::routes();

Route::namespace('\App\Http\Controllers\Auth')->group(function () {
    //Verification Routes
    Route::get('/verify/{id}', 'VerifyPhoneController@show')->name('verification.verify');
    Route::post('/verify/{id}', 'VerifyPhoneController@verify');
    Route::post('/resend', 'VerifyPhoneController@resend')->name('verification.resend');
});
