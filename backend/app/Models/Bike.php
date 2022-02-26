<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\BikeImage;
use App\Models\BikeComment;
use App\Models\BikeLike;
use App\Models\Tag;
use App\Models\Maker;
use App\Models\Type;


class Bike extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'maker_id',
        'type_id',
        'name',
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
                $q->where('name', 'LIKE', '%' . $value . '%');
            })
            ->orWhere('title', 'LIKE', '%' . $value . '%')
            ->orWhere('name', 'LIKE', '%' . $value . '%')
            ->orWhere('engine_size', 'LIKE', '%' . $value . '%')
            ->orWhere('description', 'LIKE', '%' . $value . '%')
            ->orWhereIn('maker_id', function($q) use ($value){
                $q->select('id')
                    ->from('makers')
                    ->where('name', 'LIKE' ,'%' . $value . '%');
                })
            ->orWhereIn('type_id', function ($q) use ($value) {
                $q->select('id')
                    ->from('types')
                    ->where('name', 'LIKE', '%' . $value . '%');
            });
        };

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
        return $this->belongsToMany(Tag::class)->withPivot('tag_id');
    }

    public function maker()
    {
        return $this->belongsTo(Maker::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
