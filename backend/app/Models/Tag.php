<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Road;
use App\Models\Bike;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function bikes()
    {
        return $this->belongsToMany(Bike::class);
    }

    public function roads()
    {
        return $this->belongsToMany(Road::class);
    }
}
