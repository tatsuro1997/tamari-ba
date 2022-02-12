<?php

namespace App\Policies;

use App\Models\Road;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoadPolicy
{
    use HandlesAuthorization;

    public function edit(User $user, Road $road)
    {
        // ユーザーidが投稿者と同じまたは、オーナー権限かつオーナーメールアドレスが一致する場合アクション可能
        return $user->id == $road->user_id || $user->role == 1 && $user->email == env('OWNER_EMAIL');    }

    public function update(User $user, Road $road)
    {
        // ユーザーidが投稿者と同じまたは、オーナー権限かつオーナーメールアドレスが一致する場合アクション可能
        return $user->id == $road->user_id || $user->role == 1 && $user->email == env('OWNER_EMAIL');    }

    public function delete(User $user, Road $road)
    {
        // ユーザーidが投稿者と同じまたは、オーナー権限かつオーナーメールアドレスが一致する場合アクション可能
        return $user->id == $road->user_id || $user->role == 1 && $user->email == env('OWNER_EMAIL');    }
}
