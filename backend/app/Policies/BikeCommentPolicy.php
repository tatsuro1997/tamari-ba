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
        // ユーザーidが投稿者と同じまたは、オーナー権限かつオーナーメールアドレスが一致する場合アクション可能
        return $user->id == $bikeComment->user_id || $user->role == 1 && $user->email == env('OWNER_EMAIL');
    }
}
