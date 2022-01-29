<?php

namespace App\Policies;

use App\Models\RoadComment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoadCommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RoadComment  $roadComment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, RoadComment $roadComment)
    {
        return $user->id == $roadComment->user_id;
    }
}
