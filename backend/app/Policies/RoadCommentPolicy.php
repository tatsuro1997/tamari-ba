<?php

namespace App\Policies;

use App\Models\RoadComment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoadCommentPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, RoadComment $roadComment)
    {
        // ユーザーidが投稿者と同じまたは、オーナー権限かつオーナーメールアドレスが一致する場合アクション可能
        return $user->id == $roadComment->user_id || $user->role == 1 && $user->email == env('OWNER_EMAIL');
    }
}
