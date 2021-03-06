<?php

namespace Akkurate\LaravelContact;

use Akkurate\LaravelContact\Console\ContactSeed;
use Akkurate\LaravelContact\Console\CreateGeocodesIfEmptyFields;
use Akkurate\LaravelContact\Models\Address;
use Akkurate\LaravelContact\Observers\AddressObserver;
use Illuminate\Support\ServiceProvider;

/**
 * LaravelContact service provider
 *
 */
class LaravelContactServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('laravel-contact.routes.api.enabled')) {
            $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        }

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->publishes([
            __DIR__.'/../config/laravel-contact.php' => config_path('laravel-contact.php')
        ], 'config');

        if ($this->app->runningInConsole()) {
            $this->commands([
                ContactSeed::class,
                CreateGeocodesIfEmptyFields::class
            ]);
        }

        Address::observe(AddressObserver::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/laravel-contact.php',
            'laravel-contact'
        );
    }
}
