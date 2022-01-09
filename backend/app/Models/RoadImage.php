<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Road;

class RoadImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'road_id',
        'filename',
    ];

    public function road()
    {
        return $this->belongsTo(Road::class);
    }
}
