<?php

namespace Akkurate\LaravelContact\Models;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Email extends Model
{

    protected $table = 'contact_emails';
    protected $fillable = ['type_id','name','email','priority','is_default','is_active','emailable_type','emailable_id'];

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

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function emailable()
    {
        return $this->morphTo();
    }
}
