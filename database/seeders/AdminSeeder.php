<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'first_name'        => 'Freddy',
            'last_name'         => 'McFredderson',
            'email'             => 'freddy.mcfredderson@fake.com',
            'phone'             => fake()->unique()->e164PhoneNumber(),
            'email_verified_at' => now(),
            'password'          => Hash::make('freddy.mcfredderson@fake.com'),
            'remember_token'    => Str::random(10),
        ]);

        // add admin role to user
        $user = User::where('email', 'freddy.mcfredderson@fake.com')->first();
        $user->assignRole('admin');
    }
}
