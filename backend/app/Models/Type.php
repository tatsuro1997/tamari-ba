<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bike;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function bikes()
    {
        return hasMany(Bike::class);
    }
}
