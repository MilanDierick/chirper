<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use Exception;
use Illuminate\Console\Command;

class CreateReservationsCommand extends Command
{
    protected $signature = 'create:reservations {count=1 : The number of reservations to create}';

    protected $description = 'Create a specified number of reservations using the Reservation factory';

    public function handle(): void
    {
        $count   = (int) $this->argument('count');
        $created = 0;

        for ($i = 0; $i < $count; $i++) {
            try {
                Reservation::factory()->create();
                $created++;
            } catch (Exception $e) {
                continue;
            }
        }

        $this->info("Successfully created $created reservation(s).");
    }
}
