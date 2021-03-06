<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Bike;
use App\Models\BikeComment;
use App\Models\BikeLike;
use App\Models\Road;
use App\Models\Prefecture;
use App\Models\Board;
use App\Models\RoadComment;
use App\Models\RoadLike;
use App\Models\BoardComment;
use App\Models\YearsOfExperience;
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
        'uid',
        'background_image',
        'prolife',
        'url',
        'email',
        'password',
        'birthday',
        'gender',
        'prefecture_id',
        'years_of_experience',
        'through',
        'agree'
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

    public function bikeComments()
    {
        return $this->hasMany(BikeComment::class);
    }

    public function bikeLikes()
    {
        return $this->hasMany(BikeLike::class);
    }

    public function roads(){
        return hasMany(Road::class);
    }

    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class);
    }

    public function experience()
    {
        return $this->belongsTo(YearsOfExperience::class);
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
