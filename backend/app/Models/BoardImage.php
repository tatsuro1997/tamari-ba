<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Board;

class BoardImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'board_id',
        'filename'
    ];

    public function board()
    {
        return $this->belongsTo(Board::class);
    }

}
