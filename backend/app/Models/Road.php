<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\RoadImage;
use App\Models\RoadComment;

class Road extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'latitude',
        'longitude',
        'description',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function roadImages()
    {
        return $this->hasMany(RoadImage::class);
    }

    public function roadComments()
    {
        return $this->hasMany(RoadComment::class);
    }
}
