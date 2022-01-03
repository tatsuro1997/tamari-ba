<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Road extends Model
{
    use HasFactory;

    public function user(){
        return belongsTo(User::class);
    }
}
