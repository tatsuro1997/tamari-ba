<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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

    public function users()
    {
        return belongsToMany(User::class);
    }
}
