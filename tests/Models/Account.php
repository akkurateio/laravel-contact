<?php

namespace Akkurate\LaravelContact\Tests\Models;

use Akkurate\LaravelContact\Traits\Contactable;
use Akkurate\LaravelCore\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasUuid, Contactable;

    protected $table = 'accounts';

    protected $fillable = ['name', 'email', 'preference_id'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function preference()
    {
        return $this->belongsTo(Preference::class);
    }
}
