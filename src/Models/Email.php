<?php

namespace Akkurate\LaravelContact\Models;

use Akkurate\LaravelCore\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasUuid;

    protected $table = 'contact_emails';
    protected $fillable = ['type_id','name','email','priority','is_default','is_active','emailable_type','emailable_id'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function emailable()
    {
        return $this->morphTo();
    }
}
