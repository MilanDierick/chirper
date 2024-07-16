<?php

namespace Database\Factories;

use App\Models\ClassLevel;
use App\Models\Event;
use App\Models\EventStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        return [
            'title'          => $this->faker->words(3, true),
            'description'    => $this->faker->paragraph(),
            'prerequisites'  => $this->faker->sentence(),
            'spots'          => $this->faker->numberBetween(0, 20),
            'spots_taken'    => 0,
            'waitlist'       => $this->faker->numberBetween(0, 10),
            'waitlist_taken' => 0,
            'start'          => Carbon::now(),
            'end'            => Carbon::now(),
            'grace'          => Carbon::now(),
            'address'        => $this->faker->address(),
            'mail_subject'   => $this->faker->word(),
            'mail_body'      => implode("\n", $this->faker->paragraphs()),  // Convert array to string
            'sorting'        => 1,
            'created_at'     => Carbon::now(),
            'updated_at'     => Carbon::now(),

            'author_id' => User::inRandomOrder()->first()->id,
            'status_id' => EventStatus::first()->id,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Event $event) {
            // Fetch all class levels
            $classLevels = ClassLevel::all();

            // Generate a random continuous range of class levels
            $min = $classLevels->random()->id;
            $max = $classLevels->random()->id;

            // Ensure the min value is less than the max value
            if ($min > $max) {
                $temp = $min;
                $min  = $max;
                $max  = $temp;
            }

            // Get the class levels within the range
            $classes = ClassLevel::where('id', '>=', $min)
                                 ->where('id', '<=', $max)
                                 ->get();

            // Attach the class levels to the event
            $event->classLevels()->attach($classes);
        });
    }
}
