<?php

namespace App\Policies;

use App\Models\Bike;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BikePolicy
{
    use HandlesAuthorization;

    public function edit(User $user, Bike $road)
    {
        return $user->id == $road->user_id;
    }

    public function update(User $user, Bike $road)
    {
        return $user->id == $road->user_id;
    }

    public function delete(User $user, Bike $road)
    {
        return $user->id == $road->user_id;
    }
}
