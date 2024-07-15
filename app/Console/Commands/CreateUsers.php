<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:users {count=1 : The number of users to create}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a specified number of users using the User factory';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $count = (int) $this->argument('count');
        User::factory()->count($count)->create();

        $this->info("Successfully created {$count} user(s).");
    }
}
