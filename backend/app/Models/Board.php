<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BoardUser;
use App\Models\BoardImage;

class Board extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'location',
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
}
