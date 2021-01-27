<?php

namespace Akkurate\LaravelContact\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use Sluggable;

    protected $fillable = ['name', 'slug', 'number'];

    protected $table = 'contact_departments';

    /**
     * Get the options for generating the slug.
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
