<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{

    use HasApiTokens, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guard_name = 'web';
    protected $fillable = [
        'name', 'email','phone', 'password','status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */



    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function business()
    {
        return $this->hasMany(Business::class);
    }

//    public function setPasswordAttribute($password)
//    {
//        $this->attributes['password'] = bcrypt($password);
//    }


//    public function order()
//    {
//        return $this->hasMany(Order::class);
//    }
}
