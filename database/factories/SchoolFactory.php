<?php

namespace Database\Factories;

use App\Models\School;
use App\Models\SchoolType;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchoolFactory extends Factory
{
    protected $model = School::class;

    public function definition(): array
    {
        return [
            'name'           => $this->faker->company(),
            'city'           => $this->faker->city(),
            'school_type_id' => SchoolType::inRandomOrder()->first()->id,
        ];
    }
}
