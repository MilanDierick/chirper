<?php

namespace Database\Factories;

use App\Models\Child;
use App\Models\Event;
use App\Models\Reservation;
use App\Models\ReservationType;
use App\Observers\ReservationObserver;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    /**
     * @throws Exception
     */
    public function definition(): array
    {
        // find a random child
        $child = Child::inRandomOrder()->first();

        // find a random event that the child doesn't have a reservation for
        $event = Event::whereDoesntHave('reservations', function ($query) use ($child) {
            $query->where('child_id', $child->id);
        })->inRandomOrder()->first();

        if ( ! $child || ! $event) {
            return [];
        }

        $observer = new ReservationObserver();
        $observer->handleRequestType($event, $child);

        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'reservation_type_id' => ReservationType::where('type', 'request')->first()->id,
            'child_id'            => $child->id,
            'event_id'            => $event->id,
        ];
    }
}
