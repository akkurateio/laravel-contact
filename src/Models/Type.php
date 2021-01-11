<?php

namespace Akkurate\LaravelContact\Models;

use Akkurate\LaravelContact\Database\Factories\TypeFactory;
use Akkurate\LaravelCore\Traits\HasUuid;
use Akkurate\LaravelCore\Traits\IsActivable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use HasUuid;
    use softDeletes;
    use HasFactory;
    use IsActivable;

    protected $table = 'contact_types';

    protected $fillable = ['code','name', 'shortname','description','priority','is_active'];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return TypeFactory::new();
    }
}
