<?php

namespace App\Policies;

use App\Models\BikeComment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BikeCommentPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, BikeComment $bikeComment)
    {
        return $user->id == $bikeComment->user_id;
    }
}
