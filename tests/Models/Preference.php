<?php

namespace Akkurate\LaravelContact\Tests\Models;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    protected $table = 'preferences';
    protected $fillable = ['pagination'];
}
