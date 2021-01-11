<?php

Route::group([
    'namespace' => 'Akkurate\LaravelContact\Http\Controllers\Api',
    'middleware' => config('laravel-contact.routes.api.middleware'),
    'prefix' => config('laravel-contact.routes.api.prefix'),
    'as' => config('laravel-contact.routes.api.as')
], function() {
    Route::apiResource('phones', 'PhoneController');
    Route::apiResource('addresses', 'AddressController');
    Route::apiResource('emails', 'EmailController');
    Route::apiResource('types', 'TypeController');
});

