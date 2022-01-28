<?php

namespace App\Policies;

use App\Models\Board;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BoardPolicy
{
    use HandlesAuthorization;

    public function edit(User $user, Board $board)
    {
        return $user->id == $board-> boardUsers->first()->user_id;
    }


    public function update(User $user, Board $board)
    {
        return $user->id == $board-> boardUsers->first()->user_id;
    }


    public function delete(User $user, Board $board)
    {
        return $user->id == $board-> boardUsers->first()->user_id;
    }
}
