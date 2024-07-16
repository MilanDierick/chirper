<?php

namespace Database\Seeders;

use App\Models\EventStatus;
use Illuminate\Database\Seeder;

class EventStatusSeeder extends Seeder
{
    public function run(): void
    {
        // create event statuses
        $eventStatuses = [
            'request',
            'open',
            'waitlist',
            'full',
            'cancelled',
        ];

        foreach ($eventStatuses as $status) {
            EventStatus::create(['status' => $status]);
        }
    }
}
