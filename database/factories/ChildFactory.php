<?php

namespace Database\Factories;

use App\Models\Child;
use App\Models\ClassLevel;
use App\Models\School;
use App\Models\SchoolType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ChildFactory extends Factory
{
    protected $model = Child::class;

    public function definition(): array
    {
        return [
            'last_name'     => $this->faker->lastName(),
            'first_name'    => $this->faker->firstName(),
            'date_of_birth' => $this->faker->date(),
            'information'   => $this->faker->sentence(),
            'special_needs' => $this->faker->boolean(),
            'media_consent' => $this->faker->boolean(),
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),

            'class_level_id' => ClassLevel::inRandomOrder()->first()->id,
            'parent_id'      => User::inRandomOrder()->first()->id,
            'school_id'      => School::inRandomOrder()->first()->id,
        ];
    }
}
