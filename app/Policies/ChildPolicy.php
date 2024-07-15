<?php

namespace App\Policies;

use App\Models\Child;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChildPolicy
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

    public function create(): bool
    {
        return true;
    }

    public function update(User $user, Child $child): bool
    {
        return $user->can('update children') || $user->id === $child->parent()->is($user);
    }

    public function delete(User $user, Child $child): bool
    {
        return $user->can('delete children') || $user->id === $child->parent()->is($user);
    }

    public function restore(User $user): bool
    {
        return $user->can('restore children');
    }
}
