<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    public function viewAny(): bool
    {
        return true;
    }

    public function view(): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->can('create events');
    }

    public function update(User $user, Event $event): bool
    {
        return $user->can('update events') || $event->author()->is($user);
    }

    public function delete(User $user, Event $event): bool
    {
        return $user->can('delete events') || $event->author()->is($user);
    }

    public function restore(User $user, Event $event): bool
    {
        return $user->can('restore events') || $event->author()->is($user);
    }

    public function export(User $user, Event $event): bool
    {
        return $user->can('export events') || $event->author()->is($user);
    }
}
