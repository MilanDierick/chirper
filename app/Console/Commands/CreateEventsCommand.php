<?php

namespace App\Console\Commands;

use App\Models\Event;
use Illuminate\Console\Command;

class CreateEventsCommand extends Command
{
    protected $signature = 'create:events {count=1 : The number of events to create}';

    protected $description = 'Create a specified number of events using the Event factory';

    public function handle(): void
    {
        $count = (int) $this->argument('count');
        Event::factory()->count($count)->create();

        $this->info("Successfully created $count event(s).");
    }
}
