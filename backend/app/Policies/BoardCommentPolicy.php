<?php

namespace App\Policies;

use App\Models\BoardComment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BoardCommentPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, BoardComment $boardComment)
    {
        return $user->id == $boardComment->user_id;
    }
}
