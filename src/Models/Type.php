<?php

namespace Akkurate\LaravelContact\Models;

use Akkurate\LaravelContact\Database\Factories\TypeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Webpatser\Uuid\Uuid;

class Type extends Model
{
    use softDeletes, HasFactory;

    protected $table = 'contact_types';

    protected $fillable = ['code','name', 'shortname','description','priority','is_active'];

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
        return TypeFactory::new();
    }

    public function scopeActive($query)
    {
        return $query
            ->where('is_active', true);
    }

    public function isActive()
    {
        return $this->is_active;
    }

    public function activate()
    {
        return $this->update([
            'is_active' => true
        ]);
    }

    public function deactivate()
    {
        return $this->update([
            'is_active' => false
        ]);
    }

    public function toggle()
    {
        return $this->update([
            'is_active' => ! $this->is_active
        ]);
    }
}
