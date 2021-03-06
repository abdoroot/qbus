<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\fcm;
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


Route::any('test_notification', function (Request $request){

    $fcm = new fcm();
    $input    = $request->all();
    $topic = $input['topic'];
    $title = $input['title'];
    $body  = $input['body'];
    $data  = $input['data'];

    $code =  $fcm->sendFCM($topic,$title,$body,$data);

    if($code){
        $code = 1;
        $message ='notification Sent';
    }else{
        $code =0;
        $message ='error notification Sending';
    }

    $array = [
        'code' => $code,
        'message' => $message,
        'data' => [
            'message' => $message,
        ]
    ];

   return response()->json($array);

});


Route::post('signup', 'UserAPIController@signup');
Route::post('login', 'UserAPIController@login');
Route::post('forget_password', 'UserAPIController@forgetPassword');
Route::post('reset_password', 'UserAPIController@resetPassword');
Route::get('cites', 'SettingsAPIController@cites');
Route::get('cites/{id}', 'SettingsAPIController@showCity');
Route::get('about_us', 'SettingsAPIController@aboutUs');
Route::get('contact_us_details', 'SettingsAPIController@contactUsDetails');
Route::get('social', 'SettingsAPIController@social');
Route::get('additionals', 'SettingsAPIController@additionals');
Route::get('packageAdditionals/{id}', 'SettingsAPIController@packageAdditionals');
Route::get('tripAdditionals/{id}', 'SettingsAPIController@tripAdditionals');
Route::get('additionals/{id}', 'SettingsAPIController@showAdditionals');
Route::get('privacy_policy', 'SettingsAPIController@privacyPolicy');
Route::get('return_policy', 'SettingsAPIController@returnPolicy');
Route::any('trips','TripAPIController@index');
Route::any('packages','PackageAPIController@index');
Route::any('packageDetail/{id}','PackageAPIController@show');
Route::post('contact_us', 'ContactAPIController@storeAPi'); //todo design to


//////////////////////////////////////////////////////////////

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('logout', 'UserAPIController@logout');
    Route::get('user_info', 'UserAPIController@userInfo');
    Route::post('verify_phone', 'UserAPIController@verifyPhone');
    Route::post('update_profile', 'UserAPIController@updateProfile');
    Route::get('resend_verification_code', 'UserAPIController@resendVerificationCode');

    Route::resource('bus_orders', BusOrderAPIController::class);
    Route::resource('trip_orders', TripOrderAPIController::class);
    Route::resource('oneway_orders', OnewayAPIController::class);
    Route::resource('round_orders', RoundAPIController::class);
    Route::resource('multi_orders', MultiAPIController::class);
    Route::resource('package_orders', PackageOrderAPIController::class);

    Route::get('chat', 'ChatAPIController@index');
    Route::get('chat/{id}', 'ChatAPIController@show');
    Route::post('chat', 'ChatAPIController@store');

});

Route::post('trip_review', 'ReviewAPIController@tripReview');
Route::post('package_review', 'ReviewAPIController@packageReview');

//
//Route::resource('users', UserAPIController::class);
//
//Route::resource('notifications', NotificationAPIController::class);
//
Route::get('providers/fees/{provider_id}/{destination}', 'ProviderAPIController@getFees')->name('providers.fees');
Route::resource('providers', ProviderAPIController::class);
//
//Route::resource('contacts', ContactAPIController::class);
//
//Route::resource('cities', CityAPIController::class);
//
//Route::resource('categories', CategoryAPIController::class);
//
//Route::resource('accounts', AccountAPIController::class);
//
Route::resource('buses', BusAPIController::class);
//
//Route::resource('destinations', DestinationAPIController::class);
//
Route::get('packages/get-additionals', 'PackageAPIController@getAdditionals')->name('packages.additionals');
//Route::resource('packages', PackageAPIController::class);
//
Route::get('trips/get-additionals', 'TripAPIController@getAdditionals')->name('trips.additionals');
//Route::resource('trips', TripAPIController::class);
//
//Route::resource('reviews', ReviewAPIController::class);
//
//Route::resource('tickets', TicketAPIController::class);
//
//Route::resource('features', App\Http\Controllers\API\FeatureAPIController::class);
//
//Route::resource('services', App\Http\Controllers\API\ServiceAPIController::class);
//
//Route::resource('emails', App\Http\Controllers\API\EmailAPIController::class);
//
////Route::resource('additionals', App\Http\Controllers\API\AdditionalAPIController::class);
//
//Route::resource('terminals', App\Http\Controllers\API\TerminalAPIController::class);
//
//Route::resource('coupons', App\Http\Controllers\API\CouponAPIController::class);
