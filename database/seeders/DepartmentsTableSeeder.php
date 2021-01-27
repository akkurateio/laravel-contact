<?php

namespace Akkurate\LaravelContact\Database\Seeders;

use Akkurate\LaravelContact\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            'name' => 'Ariège',
            'number' => '09'
        ]);
        Department::create([
            'name' => 'Aude',
            'number' => '11'
        ]);
        Department::create([
            'name' => 'Aveyron',
            'number' => '12'
        ]);
        Department::create([
            'name' => 'Gard',
            'number' => '30'
        ]);
        Department::create([
            'name' => 'Gers',
            'number' => '32'
        ]);
        Department::create([
            'name' => 'Haute-Garonne',
            'number' => '31'
        ]);
        Department::create([
            'name' => 'Hautes-Pyrénées',
            'number' => '65'
        ]);
        Department::create([
            'name' => 'Hérault',
            'number' => '34'
        ]);
        Department::create([
            'name' => 'Lot',
            'number' => '46'
        ]);
        Department::create([
            'name' => 'Lozère',
            'number' => '48'
        ]);
        Department::create([
            'name' => 'Pyrénées-Orientales',
            'number' => '66'
        ]);
        Department::create([
            'name' => 'Tarn',
            'number' => '81'
        ]);
        Department::create([
            'name' => 'Tarn-et-Garonne',
            'number' => '82'
        ]);
    }
}
