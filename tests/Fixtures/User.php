<?php

namespace Akkurate\LaravelContact\Tests\Fixtures;

use Akkurate\LaravelContact\Traits\Contactable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Contactable;

    protected $table = 'users';
    protected $fillable = ['account_id', 'preference_id'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function preference()
    {
        return $this->belongsTo(Preference::class);
    }
}
