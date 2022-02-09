<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Bike;
use App\Models\Road;
use App\Models\Prefecture;
use App\Models\Board;
use App\Models\RoadComment;
use App\Models\RoadLike;
use App\Models\BoardComment;
use App\Notifications\User\ResetPassword;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'avatar',
        'background_image',
        'prolife',
        'url',
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
        return hasMany(Bike::class);
    }

    public function roads(){
        return hasMany(Road::class);
    }

    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class);
    }

    public function boards()
    {
        return $this->hasMany(Board::class);
    }

    public function roadComments()
    {
        return $this->hasMany(RoadComment::class);
    }

    public function roadLikes()
    {
        return $this->hasMany(RoadLike::class);
    }

    public function boardComments()
    {
        return $this->hasMany(BoardComment::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
}
