<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\BikeImage;
use App\Models\BikeComment;
use App\Models\BikeLike;
use App\Models\Tag;

class Bike extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'bike_brand',
        'bike_type',
        'bike_name',
        'engine_size',
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
                $q->where('name', 'like', '%' . $value . '%');
            })
                ->orWhere('title', 'LIKE', '%' . $value . '%')
                ->orWhere('description', 'like', '%' . $value . '%');
        }

        // 上記で取得した$queryを投稿日降順、ページネートにし、roadsに代入
        return $query->orderBy('created_at', 'desc')->paginate(12);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bikeImages()
    {
        return $this->hasMany(BikeImage::class);
    }

    public function bikeComments()
    {
        return $this->hasMany(BikeComment::class);
    }

    public function bikeLikes()
    {
        return $this->hasMany(BikeLike::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
