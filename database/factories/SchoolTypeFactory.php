<?php

namespace Database\Factories;

use App\Models\SchoolType;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchoolTypeFactory extends Factory
{
    protected $model = SchoolType::class;

    public function definition(): array
    {
        return [
            'type' => $this->faker->word(),
        ];
    }
}
