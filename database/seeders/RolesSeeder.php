<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        Role::create(['name' => 'admin']);

        $adminRole = Role::where('name', 'admin')->first();

        $adminRole->givePermissionTo([
            'view users',
            'create users',
            'update users',
            'delete users',

            'view roles',
            'create roles',
            'update roles',
            'delete roles',

            'view permissions',
            'create permissions',
            'update permissions',
            'delete permissions',

            'update children',
            'delete children',
            'restore children',

            'create events',
            'update events',
            'delete events',
            'restore events',
            'export events',
        ]);
    }
}
