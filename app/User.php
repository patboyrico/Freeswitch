<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function endusers()
    {
        return $this->hasOne(EndUser::class, 'user_id');
    }

    public function user_configuration()
    {
        return $this->hasOne(UserConfiguration::class,'user_id');
    }

    public function user_extension()
    {
        return $this->hasOne(UserExtension::class,'user_id');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name. ' '. $this->last_name;
    }


}
