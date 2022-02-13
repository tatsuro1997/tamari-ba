<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bike;
use App\Models\User;

class BikeLike extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bike()
    {
        return $this->belongsTo(Bike::class);
    }

    //いいねが既にされているかを確認
    public function like_exist($id, $bike_id)
    {
        //Likesテーブルのレコードにユーザーidと投稿idが一致するものを取得
        $exist = BikeLike::where('user_id', $id)->where('bike_id', $bike_id)->get();

        // レコード（$exist）が存在するなら
        if (!$exist->isEmpty()) {
            return true;
        } else {
            // レコード（$exist）が存在しないなら
            return false;
        }
    }
}
