<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::resource('users', UserAPIController::class);

Route::resource('notifications', NotificationAPIController::class);

Route::get('providers/fees/{provider_id}/{destination}', 'ProviderAPIController@getFees')->name('providers.fees');
Route::resource('providers', ProviderAPIController::class);

Route::resource('contacts', ContactAPIController::class);

Route::resource('cities', CityAPIController::class);

Route::resource('categories', CategoryAPIController::class);

Route::resource('accounts', AccountAPIController::class);

Route::resource('buses', BusAPIController::class);

Route::resource('bus_orders', BusOrderAPIController::class);

Route::resource('destinations', DestinationAPIController::class);

Route::get('packages/get-additionals', 'PackageAPIController@getAdditionals')->name('packages.additionals');
Route::resource('packages', PackageAPIController::class);

Route::get('trips/get-additionals', 'TripAPIController@getAdditionals')->name('trips.additionals');
Route::resource('trips', TripAPIController::class);

Route::resource('trip_orders', TripOrderAPIController::class);

Route::resource('reviews', ReviewAPIController::class);

Route::resource('tickets', TicketAPIController::class);

Route::resource('features', App\Http\Controllers\API\FeatureAPIController::class);

Route::resource('services', App\Http\Controllers\API\ServiceAPIController::class);

Route::resource('emails', App\Http\Controllers\API\EmailAPIController::class);

Route::resource('additionals', App\Http\Controllers\API\AdditionalAPIController::class);

Route::resource('terminals', App\Http\Controllers\API\TerminalAPIController::class);

Route::resource('coupons', App\Http\Controllers\API\CouponAPIController::class);