<?php

namespace Akkurate\LaravelContact\Models;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Phone extends Model
{
    protected $table = 'contact_phones';
    protected $fillable = ['type_id','name','number', 'prefix','priority','is_default','is_active','phoneable_type','phoneable_id'];

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

    public function phoneable()
    {
        return $this->morphTo();
    }
}
