<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BoardUser;
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
        'prefecture_id'
    ];

    public function boardUsers()
    {
        return $this->hasMany(BoardUser::class);
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
