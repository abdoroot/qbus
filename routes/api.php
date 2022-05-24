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

Route::post('register', 'UserAPIController@register');
Route::post('login', 'UserAPIController@login');
Route::get('cites', 'CityAPIController@index');
Route::get('about_us', 'SettingsAPIController@aboutUs');
Route::get('contact_us_details', 'SettingsAPIController@contactUsDetails');
Route::get('social', 'SettingsAPIController@social');
Route::get('additionals', 'SettingsAPIController@additionals');
//////////////////////////////////////////////////////////////
Route::group(['middleware' => 'auth:api'], function(){
    Route::get('logout', 'UserAPIController@logout');
    Route::get('user_info', 'UserAPIController@userInfo');
    Route::post('verify_phone', 'UserAPIController@verifyPhone');
    Route::get('resend_verification_code', 'UserAPIController@resendVerificationCode');
});

