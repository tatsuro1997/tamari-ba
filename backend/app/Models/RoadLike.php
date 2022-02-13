<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Road;

class RoadLike extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function road()
    {
        return $this->belongsTo(Road::class);
    }

    //いいねが既にされているかを確認
    public function like_exist($id, $road_id)
    {
        //Likesテーブルのレコードにユーザーidと投稿idが一致するものを取得
        $exist = RoadLike::where('user_id', $id)->where('road_id', $road_id)->get();

        // レコード（$exist）が存在するなら
        if (!$exist->isEmpty()) {
            return true;
        } else {
        // レコード（$exist）が存在しないなら
            return false;
        }
    }
}
