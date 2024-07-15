<?php

namespace Database\Seeders;

use App\Models\SchoolType;
use Illuminate\Database\Seeder;

class SchoolTypeSeeder extends Seeder
{
    public function run(): void
    {
        SchoolType::factory()->create([
            'type' => 'Gesamtschule',
        ]);

        SchoolType::factory()->create([
            'type' => 'Grundschule',
        ]);

        SchoolType::factory()->create([
            'type' => 'Förderschule',
        ]);

        SchoolType::factory()->create([
            'type' => 'Hauptschule',
        ]);

        SchoolType::factory()->create([
            'type' => 'Realschule',
        ]);

        SchoolType::factory()->create([
            'type' => 'Gymnasium',
        ]);

        SchoolType::factory()->create([
            'type' => 'Berufskolleg',
        ]);
    }
}
