<?php

namespace Akkurate\LaravelContact\Tests\Models;

use Akkurate\LaravelContact\Traits\Contactable;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Account extends Model
{
    use Contactable;

    protected $table = 'accounts';

    protected $fillable = ['name', 'email', 'preference_id'];


    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function preference()
    {
        return $this->belongsTo(Preference::class);
    }
}
