<?php

namespace Akkurate\LaravelContact\Models;

use Akkurate\LaravelContact\Database\Factories\AddressFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Address extends Model
{
    use HasFactory;

    protected $table = 'contact_addresses';
    protected $fillable = ['type_id','name','street1','street2','street3','postcode','city','priority','is_default','is_active','addressable_type','addressable_id'];

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

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return AddressFactory::new();
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function addressable()
    {
        return $this->morphTo();
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
