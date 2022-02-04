<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
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

    public function user()
    {
        return $this->belongsTo(User::class);
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
