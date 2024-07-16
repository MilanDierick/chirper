<?php

namespace App\Observers;

use App\Models\Child;
use App\Models\Event;
use App\Models\Reservation;
use Exception;
use Illuminate\Validation\ValidationException;

class ReservationObserver
{
    /**
     * @throws Exception
     */
    public function creating(Reservation $reservation): void
    {
        $this->saving($reservation);
    }

    /**
     * @throws Exception
     */
    public function updating(Reservation $reservation): void
    {
        $this->saving($reservation);
    }

    /**
     * @throws Exception
     */
    public function saving(Reservation $reservation): void
    {
        $event = $reservation->event()->first();
        $child = $reservation->child()->first();
        $type  = $reservation->reservationType()->first();

        switch ($type->type) {
            case 'request':
                $this->handleRequestType($event, $child);
                break;
            default:
                $this->abortWithMessage('Invalid reservation type.');
        }

        // The reservation is valid and all required actions have been taken.
        // Let's continue saving the reservation.
    }

    public function deleted(Reservation $reservation): void
    {
    }

    /**
     * @throws Exception if requested reservation does not meet requirements.
     */
    public function handleRequestType(Event $event, Child $child): void
    {
        $this->checkIfChildHasRequiredClassLevel($event, $child);
        $this->checkIfChildHasSchedulingConflict($event, $child);
    }

    /**
     * @throws Exception if child does not have the required class level.
     */
    private function checkIfChildHasRequiredClassLevel(Event $event, Child $child): void
    {
        $childClassLevel  = $child->classLevel()->first(); // returns a single class level
        $eventClassLevels = $event->classLevels()->get();  // returns an Eloquent Collection of class levels

        if ( ! $eventClassLevels->contains($childClassLevel)) {
            $this->abortWithMessage('Child does not have the required class level.');
        }
    }

    /**
     * @throws Exception if child has a scheduling conflict.
     */
    private function checkIfChildHasSchedulingConflict(Event $event, Child $child): void
    {
        $childReservations = $child->reservations()->get();
        $eventStart        = $event->start;
        $eventEnd          = $event->end;

        foreach ($childReservations as $reservation) {
            $reservationEvent = $reservation->event()->firstOrFail();
            $reservationStart = $reservationEvent->start;
            $reservationEnd   = $reservationEvent->end;

            if ($eventStart >= $reservationStart && $eventStart <= $reservationEnd) {
                $this->abortWithMessage('Child has a scheduling conflict.');
            }

            if ($eventEnd >= $reservationStart && $eventEnd <= $reservationEnd) {
                $this->abortWithMessage('Child has a scheduling conflict.');
            }
        }
    }

    private function abortWithMessage(string $message): void
    {
        throw ValidationException::withMessages(['error' => $message]);
    }
}
