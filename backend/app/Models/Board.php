<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Prefecture;
use App\Models\BoardImage;
use App\Models\BoardComment;

class Board extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'location',
        'destination',
        'description',
        'deadline',
        'prefecture_id',
        'user_id'
    ];

    public function scopeSearch($query, $search)
    {
        // 全角スペースを半角に変換
        $spaceConversion = mb_convert_kana($search, 's');
        // 単語を半角スペースで区切り、配列にする（例："山田 翔" → ["山田", "翔"]）
        $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);

        // 単語をループで回し、タグ名、投稿のタイトル、説明と部分一致するものがあれば、$queryとして保持される
        foreach ($wordArraySearched as $value) {
            $query->whereHas('prefecture', function ($q) use ($value) {
                $q->where('name', 'like', '%' . $value . '%');
            })
                ->orWhere('title', 'LIKE', '%' . $value . '%')
                ->orWhere('location', 'LIKE', '%' . $value . '%')
                ->orWhere('destination', 'LIKE', '%' . $value . '%')
                ->orWhere('description', 'like', '%' . $value . '%');
        }

        // 上記で取得した$queryを投稿日降順、ページネートにし、boardsに代入
        return $query->orderBy('created_at', 'desc')->paginate(12);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class);
    }

    public function boardImages()
    {
        return $this->hasMany(BoardImage::class);
    }

    public function boardComments()
    {
        return $this->hasMany(BoardComment::class);
    }
}
