<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SchoolTypeSeeder::class,
            SchoolSeeder::class,
            PermissionsSeeder::class,
            RolesSeeder::class,
            AdminSeeder::class,
        ]);
    }
}
