<?php

namespace Akkurate\LaravelContact\Tests\Fixtures;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    protected $table = 'preferences';
    protected $fillable = ['pagination'];
}
