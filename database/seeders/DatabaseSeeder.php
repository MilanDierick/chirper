<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            EventStatusSeeder::class,
            ClassLevelSeeder::class,
            SchoolTypeSeeder::class,
            SchoolSeeder::class,
            PermissionsSeeder::class,
            RolesSeeder::class,
            AdminSeeder::class,
        ]);
    }
}
