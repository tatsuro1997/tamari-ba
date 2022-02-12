<?php

namespace App\Policies;

use App\Models\Bike;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BikePolicy
{
    use HandlesAuthorization;

    public function edit(User $user, Bike $bike)
    {
        // ユーザーidが投稿者と同じまたは、オーナー権限かつオーナーメールアドレスが一致する場合アクション可能
        return $user->id == $bike->user_id || $user->role == 1 && $user->email == env('OWNER_EMAIL');
    }

    public function update(User $user, Bike $bike)
    {
        // ユーザーidが投稿者と同じまたは、オーナー権限かつオーナーメールアドレスが一致する場合アクション可能
        return $user->id == $bike->user_id || $user->role == 1 && $user->email == env('OWNER_EMAIL');
    }

    public function delete(User $user, Bike $bike)
    {
        // ユーザーidが投稿者と同じまたは、オーナー権限かつオーナーメールアドレスが一致する場合アクション可能
        return $user->id == $bike->user_id || $user->role == 1 && $user->email == env('OWNER_EMAIL');
    }
}
