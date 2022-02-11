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
        // ユーザーidが投稿者と同じまたは、オーナー権限かつオーナーメールアドレスが一致する場合アクション可能
        return $user->id == $board->user_id || $user->role == 1 && $user->email == env('OWNER_EMAIL');
    }


    public function update(User $user, Board $board)
    {
        // ユーザーidが投稿者と同じまたは、オーナー権限かつオーナーメールアドレスが一致する場合アクション可能
        return $user->id == $board->user_id || $user->role == 1 && $user->email == env('OWNER_EMAIL');
    }


    public function delete(User $user, Board $board)
    {
        // ユーザーidが投稿者と同じまたは、オーナー権限かつオーナーメールアドレスが一致する場合アクション可能
        return $user->id == $board->user_id || $user->role == 1 && $user->email == env('OWNER_EMAIL');
    }
}
