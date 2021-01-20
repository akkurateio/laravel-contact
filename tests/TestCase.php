<?php

namespace Akkurate\LaravelContact\Tests;

use Akkurate\LaravelBackComponents\LaravelBackComponentsServiceProvider;
use Akkurate\LaravelContact\LaravelContactServiceProvider;
use Akkurate\LaravelContact\Tests\Fixtures\Account;
use Akkurate\LaravelContact\Tests\Fixtures\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Spatie\JsonApiPaginate\JsonApiPaginateServiceProvider;

class TestCase extends OrchestraTestCase
{
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpDatabase();

        $this->createUser();
        $this->user = User::first();
        auth()->login($this->user);
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelContactServiceProvider::class,
            JsonApiPaginateServiceProvider::class,
            LaravelBackComponentsServiceProvider::class,
        ];
    }

    protected function setUpDatabase()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->default('');
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->foreignId('address_id')->nullable()->constrained('contact_addresses')->onDelete('cascade');
            $table->foreignId('phone_id')->nullable()->constrained('contact_phones')->onDelete('cascade');
            $table->foreignId('email_id')->nullable()->constrained('contact_emails')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->default('');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->foreignId('account_id')->nullable()->constrained('accounts')->onDelete('cascade');
            $table->foreignId('address_id')->nullable()->constrained('contact_addresses')->onDelete('cascade');
            $table->foreignId('phone_id')->nullable()->constrained('contact_phones')->onDelete('cascade');
            $table->foreignId('email_id')->nullable()->constrained('contact_emails')->onDelete('cascade');
            $table->timestamps();
        });

    }

    protected function createUser()
    {
        $account = Account::create([
            'name' => 'Account',
            'email' => 'account@email.com',
        ]);

        User::forceCreate([
            'name' => 'User',
            'email' => 'user@email.com',
            'password' => 'test',
            'account_id' => $account->id,
        ]);
    }
}
