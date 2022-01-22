<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Road;

class RoadComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'road_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function road()
    {
        return $this->belongsTo(Road::class);
    }
}
