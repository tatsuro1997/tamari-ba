<?php

namespace App\Policies;

use App\Models\Road;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoadPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Road  $road
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Road $road)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    public function edit(User $user, Road $road)
    {
        return $user->id == $road->user_id;
    }


    public function update(User $user, Road $road)
    {
        return $user->id == $road->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Road  $road
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Road $road)
    {
        return $user->id == $road->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Road  $road
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Road $road)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Road  $road
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Road $road)
    {
        //
    }
}
