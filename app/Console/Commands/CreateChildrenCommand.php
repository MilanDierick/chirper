<?php

namespace App\Console\Commands;

use App\Models\Child;
use Illuminate\Console\Command;

class CreateChildrenCommand extends Command
{
    protected $signature = 'create:children {count=1 : The number of children to create}';

    protected $description = 'Create a specified number of children using the Child factory';

    public function handle(): void
    {
        $count = (int) $this->argument('count');
        Child::factory()->count($count)->create();

        $this->info("Successfully created $count child(ren).");
    }
}
