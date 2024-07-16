<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'update children']);
        Permission::create(['name' => 'delete children']);
        Permission::create(['name' => 'restore children']);

        Permission::create(['name' => 'create events']);
        Permission::create(['name' => 'update events']);
        Permission::create(['name' => 'delete events']);
        Permission::create(['name' => 'restore events']);
        Permission::create(['name' => 'export events']);
    }
}
