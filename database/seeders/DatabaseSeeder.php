<?php

namespace Akkurate\LaravelContact\Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the Database Seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            DepartmentsTableSeeder::class,
            TypesTableSeeder::class,
            AddressesTableSeeder::class,
            PhonesTableSeeder::class,
            EmailsTableSeeder::class,
        ]);
    }
}
