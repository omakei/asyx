<?php

namespace App\Policies;

use App\Models\Place;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlacePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function viewAny(User $user): bool
    {
        return $user->tokenCan('place:read');
    }

    public function view(User $user, Place $place): bool
    {
        return $user->tokenCan('place:read');
    }

    public function create(User $user): bool
    {
        return $user->tokenCan('place:create');
    }

    public function update(User $user, Place $place): bool
    {
        return $user->tokenCan('place:update');
    }

    public function delete(User $user, Place $place): bool
    {
        return $user->tokenCan('place:delete');
    }
}
