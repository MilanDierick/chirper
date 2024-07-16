<?php

namespace Database\Seeders;

use App\Models\ReservationType;
use Illuminate\Database\Seeder;

class ReservationTypesSeeder extends Seeder
{
    public function run(): void
    {
        $types = ['request', 'pending', 'confirmed', 'waitlist', 'cancelled'];

        foreach ($types as $type) {
            ReservationType::create(['type' => $type]);
        }
    }
}
