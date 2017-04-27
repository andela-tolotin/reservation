<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function reservations()
    {
        return $this->hasMany('App/Reservation');
    }

    public function scopeFindOneByEmail($query, $email)
    {
        return $query
            ->where('email', $email)
            ->first();
    }

    public function scopeFindOneByUsername($query, $username)
    {
        return $query
            ->where('username', $username)
            ->orWhere('username', strtolower($username))
            ->first();
    }
}
