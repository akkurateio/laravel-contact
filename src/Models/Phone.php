<?php

namespace Akkurate\LaravelContact\Models;

use Akkurate\LaravelCore\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasUuid;

    protected $table = 'contact_phones';
    protected $fillable = ['type_id','name','number', 'prefix','priority','is_default','is_active','phoneable_type','phoneable_id'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function phoneable()
	{
		return $this->morphTo();
	}
}
