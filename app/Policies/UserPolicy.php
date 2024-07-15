<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use users;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view all users');
    }

    public function view(User $user, User $model): bool
    {
        if ($user->hasRole('organizer')) {
            return $model->whereHas('children.reservations', function ($query) {
                $query->whereHas('event', function ($query) {
                    $query->where('author_id', auth()->id())->exists();
                });
            })->exists();

            //            return $model->whereHas('children.reservations', fn($q) => $q->whereHas('event', fn($qq) => $qq->where('author_id', $user->id)->exists()))->exists();

        } else {
            return $user->can('view users') || $model->is($user);
        }
    }

    public function create(User $user): bool
    {
        return $user->can('create users');
    }

    public function update(User $user, User $model): bool
    {
        return $user->can('update users') || $model->is($user);
    }

    public function delete(User $user, User $model): bool
    {
        return $user->can('delete users') || $model->is($user);
    }

    public function restore(User $user, User $model): bool
    {
        return $user->can('restore users') || $model->is($user);
    }
}
