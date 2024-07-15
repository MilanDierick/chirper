<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

// Disable foreign key checks
DB::statement('SET FOREIGN_KEY_CHECKS=0;');

// Reset migrations
Artisan::call('migrate:reset', ['--force' => true]);

// Re-enable foreign key checks
DB::statement('SET FOREIGN_KEY_CHECKS=1;');

// Run migrations
Artisan::call('migrate', ['--force' => true]);

// Seed the database
Artisan::call('db:seed', ['--force' => true]);

echo "Database reset and seeded successfully.\n";
