<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\BoardImage;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function boardImages()
    {
        return $this->hasMany(BoardImage::class);
    }
}
