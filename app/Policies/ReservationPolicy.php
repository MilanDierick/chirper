<?php

namespace App\Policies;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReservationPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view all reservations');
    }

    public function view(User $user, Reservation $reservation): bool
    {
        return $user->can('view reservation') || $user->id === $reservation->child->parent_id;
    }

    public function create(User $user): bool
    {
        return $user->can('create reservation');
    }

    public function update(User $user, Reservation $reservation): bool
    {
        return $user->can('update reservation') || $user->id === $reservation->child->parent_id;
    }

    public function delete(User $user, Reservation $reservation): bool
    {
        return $user->can('delete reservation') || $user->id === $reservation->child->parent_id;
    }

    public function restore(User $user): bool
    {
        return $user->can('restore reservation');
    }
}
