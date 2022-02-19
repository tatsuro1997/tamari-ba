<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use App\Models\Prefecture;
use App\Models\RoadImage;
use App\Models\RoadComment;
use App\Models\RoadLike;
use App\Models\Tag;

class Road extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'latitude',
        'longitude',
        'prefecture_id',
        'description',
        'user_id',
    ];

    public function scopeSearch($query, $search)
    {
        // 全角スペースを半角に変換
        $spaceConversion = mb_convert_kana($search, 's');
        // 単語を半角スペースで区切り、配列にする（例："山田 翔" → ["山田", "翔"]）
        $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);

        // 単語をループで回し、タグ名、投稿のタイトル、説明と部分一致するものがあれば、$queryとして保持される
        foreach ($wordArraySearched as $value) {
            $query->whereHas('tags', function ($q) use ($value) {
                $q->where('name', 'like', '%' . $value . '%')
                ->orWhereIn('prefecture_id', function ($q) use ($value) {
                    $q->select('id')
                        ->from('prefectures')
                        ->where('name', 'LIKE', '%' . $value . '%');
                });
            })
                ->orWhere('title', 'LIKE', '%' . $value . '%')
                ->orWhere('description', 'like', '%' . $value . '%');
        }

        // 上記で取得した$queryを投稿日降順、ページネートにし、roadsに代入
        return $query->orderBy('created_at', 'desc')->paginate(12);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class);
    }

    public function roadImages()
    {
        return $this->hasMany(RoadImage::class);
    }

    public function roadComments()
    {
        return $this->hasMany(RoadComment::class);
    }

    public function roadLikes()
    {
        return $this->hasMany(RoadLike::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
