<?php

namespace Akkurate\LaravelContact\Models;

use Akkurate\LaravelCore\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasUuid;

    protected $table = 'contact_addresses';
    protected $fillable = ['type_id','name','street1','street2','street3','zip','city','priority','is_default','is_active','addressable_type','addressable_id'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

	public function addressable()
	{
		return $this->morphTo();
	}
}
