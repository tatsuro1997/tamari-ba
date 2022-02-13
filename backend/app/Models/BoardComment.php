<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Board;
use App\Models\User;

class BoardComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'board_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function board()
    {
        return $this->belongsTo(Board::class);
    }
}
