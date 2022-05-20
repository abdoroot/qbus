<?php

Route::middleware('auth:provider')->group(function ()
{
    Route::GET('/', 'HomeController@index')->name('home');
    Route::GET('calender', 'HomeController@calender')->name('calender');

    Route::get('profile', 'ProfileController@index')->name('profile.index');
    // Route::post('profile', 'ProfileController@update')->name('profile.settings');
    Route::post('account', 'ProfileController@account')->name('profile.account');
    Route::post('password', 'ProfileController@password')->name('profile.password');
    Route::resource('notifications', 'NotificationController')->only('index', 'show', 'update', 'destroy');

    // Orders
    Route::resource('packageOrders', 'PackageOrderController');
    Route::resource('busOrders', 'BusOrderController');
    Route::resource('tripOrders', 'TripOrderController');

    Route::middleware('accountIsAdmin')->group(function ()
    {
        Route::GET('tax_report', 'HomeController@tax_report')->name('tax_report');
        Route::post('cities', 'ProfileController@cities')->name('profile.cities');
        Route::resource('destinations', 'DestinationController');
        Route::resource('packages', 'PackageController');
        Route::resource('accounts', 'AccountController');
        Route::resource('buses', 'BusController');
        Route::resource('trips', 'TripController');
        Route::post('trips/{id}/notification', 'TripController@notification')->name('trips.notification');
        Route::resource('reviews', 'ReviewController')->only('index', 'show', 'update');
        Route::resource('terminals', 'TerminalController');
        Route::resource('coupons', 'CouponController');
    });
});

Route::namespace('\App\Http\Controllers\Provider\Auth')->group(function() {
    // Login and Logout
    Route::GET('login', 'LoginController@showLoginForm')->name('login');
    Route::POST('login', 'LoginController@login');
    Route::POST('logout', 'LoginController@logout')->name('logout');

    // Registration
    Route::GET('register', 'RegisterController@showRegistrationForm')->name('register');
    Route::POST('register', 'RegisterController@register');

    // Account
    Route::GET('account/{id}', 'RegisterController@showAccountForm')->name('account');
    Route::POST('account/{id}', 'RegisterController@account');

    // Password Resets
    Route::POST('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::GET('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::POST('password/reset', 'ResetPasswordController@reset')->name('password.update');
    Route::GET('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');

    //Verification Routes
    Route::get('verify/{id}', 'VerificationController@show')->name('verification.verify');
    Route::post('verify/{id}', 'VerificationController@verify');
    Route::post('resend', 'VerificationController@resend')->name('verification.resend');
});

Route::fallback(function () {
    return abort(404);
});