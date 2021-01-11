# Laravel Contact

Contact module to get the emails, phones, addresses of an entity.

## Installation

This package can be installed through Composer.

``` bash
composer require akkurate/laravel-contact
```

You can publish the config file with this command:
```bash
php artisan vendor:publish --provider="Akkurate\LaravelContact\LaravelContactServiceProvider" --tag="config"
```

You can seed your database.
```bash
php artisan contact:seed
```
