<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Road;

class Tag extends Model
{
    use HasFactory;

    public function roads()
    {
        return $this->belongsToMany(Road::class);
    }
}
