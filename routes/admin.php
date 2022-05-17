<?php

Route::namespace('\App\Http\Controllers\Admin\Auth')->group(function() {
    // Login and Logout
    Route::GET('/login', 'LoginController@showLoginForm')->name('login');
    Route::POST('/login', 'LoginController@login');
    Route::POST('/logout', 'LoginController@logout')->name('logout');
    // Password Resets
    Route::POST('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::GET('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::POST('/password/reset', 'ResetPasswordController@reset');
    Route::GET('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
});

Route::middleware('auth:admin')->group(function ()
{
    // Admin Home dashboard
    Route::GET('/', 'HomeController@index')->name('home');
    Route::GET('calender', 'HomeController@calender')->name('calender');
    Route::GET('tax_report', 'HomeController@tax_report')->name('tax_report');
    // Profile
    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::post('/profile', 'ProfileController@update')->name('profile.settings');
    Route::post('/password', 'ProfileController@password')->name('profile.password');
    // Translation manager
    Route::get('translation', 'HomeController@translation')->name('translation');
    // Settings
    Route::resource('settings', 'SettingController')->only('index', 'show', 'update');
    
    Route::resource('categories', 'CategoryController');
    Route::resource('cities', 'CityController');

    // App Users
    Route::resource('admins', 'AdminController');
    Route::resource('users', 'UserController');
    Route::resource('providers', 'ProviderController');
    // App Messages (notifications / contact us)
    Route::resource('notifications', 'NotificationController')->except('edit');
    Route::resource('contacts', 'ContactController');

    // Providers section
    Route::resource('accounts', 'AccountController');
    Route::resource('destinations', 'DestinationController')->only('index', 'show');
    Route::resource('packages', 'PackageController')->only('index', 'show');
    Route::resource('packageOrders', 'PackageOrderController')->only('index', 'show', 'update', 'destroy');
    Route::resource('buses', 'BusController')->only('index', 'show');
    Route::resource('busOrders', 'BusOrderController');
    Route::resource('trips', 'TripController')->only('index', 'show', 'destroy');
    Route::resource('tripOrders', 'TripOrderController')->only('index', 'show', 'update', 'destroy');
    Route::resource('reviews', 'ReviewController')->only('index', 'show', 'update', 'destroy');

    Route::resource('features', 'FeatureController');
    Route::resource('services', 'ServiceController');
    Route::resource('emails', 'EmailController');

    Route::resource('additionals', 'AdditionalController');
    Route::resource('terminals', 'TerminalController')->only('index', 'show');
    Route::resource('coupons', 'CouponController')->only('index', 'show', 'edit', 'update', 'destroy');
});

Route::fallback(function () {
    return abort(404);
});