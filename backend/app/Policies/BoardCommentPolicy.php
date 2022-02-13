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
        // ユーザーidが投稿者と同じまたは、オーナー権限かつオーナーメールアドレスが一致する場合アクション可能
        return $user->id == $boardComment->user_id || $user->role == 1 && $user->email == env('OWNER_EMAIL');;
    }
}
