<?php

namespace Database\Seeders;

use App\Models\ClassLevel;
use Illuminate\Database\Seeder;

class ClassLevelSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 12; $i++) {
            ClassLevel::create(['level' => $i]);
        }
    }
}
