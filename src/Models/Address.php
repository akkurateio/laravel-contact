<?php

namespace Akkurate\LaravelContact\Models;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Address extends Model
{
    protected $table = 'contact_addresses';
    protected $fillable = ['type_id','name','street1','street2','street3','zip','city','priority','is_default','is_active','addressable_type','addressable_id'];

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

	public function addressable()
	{
		return $this->morphTo();
	}
}
