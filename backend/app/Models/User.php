<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Bike;
use App\Models\Road;
use App\Models\Prefecture;
use App\Models\BoardUser;
use App\Models\RoadComment;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'avatar',
        'email',
        'password',
        'age',
        'gender',
        'prefecture_id',
        'years_of_experience',
        'through'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function bikes()
    {
        return belongsToMany(Bike::class);
    }

    public function roads(){
        return hasMany(Road::class);
    }

    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class);
    }

    public function boardUsers()
    {
        return $this->hasMany(BoardUser::class);
    }
    
    public function roadComments()
    {
        return $this->hasMany(RoadComment::class);
    }
}
