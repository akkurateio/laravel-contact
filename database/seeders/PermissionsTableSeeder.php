<?php

namespace Akkurate\LaravelContact\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach (config('laravel-contact.permissions') as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission['name']],
                ['label' => $permission['label'] ?? null]
            );
        }

        foreach (config('laravel-contact.roles') as $role) {
            Role::firstOrCreate(
                ['name' => $role['name']],
                ['label' => $role['label'] ?? null]
            );
        }

        foreach (config('laravel-contact.roles_permissions') as $key => $permissions) {
            $role = Role::where('name', '!=', 'superadmin')->where('name', $key)->first();
            foreach ($permissions as $permission) {
                $role->givePermissionTo($permission);
            }
        }
    }

}
