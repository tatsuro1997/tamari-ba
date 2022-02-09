<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bike;

class BikeImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'bike_id',
        'filename',
    ];

    public function bike()
    {
        return $this->belongsTo(Bike::class);
    }
}
