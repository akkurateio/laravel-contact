<?php

namespace Akkurate\LaravelContact\Database\Seeders;

use Akkurate\LaravelContact\Models\Type;
use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (config('laravel-contact.seeds.types')) {
            foreach (config('laravel-contact.seeds.types') as $type) {
                Type::updateOrCreate([
                    'code' => $type['code'],
                ], [
                    'name' => $type['name'],
                    'shortname' => $type['shortname'],
                    'description' => $type['description'],
                    'priority' => $type['priority'],
                    'is_active' => 1,
                ]);
            }
        }
    }
}
