<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\BikeImage;
use App\Models\BikeComment;

class Bike extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'bike_brand',
        'bike_type',
        'bike_name',
        'engine_size',
        'description',
        'user_id',
    ];

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
}
