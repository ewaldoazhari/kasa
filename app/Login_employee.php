<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Login_employee extends Authenticatable
{
    use Notifiable,HasApiTokens, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'outlet_id','name', 'email', 'pin', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
//    protected $hidden = [
//        'password', 'remember_token',
//    ];

}





//    public function getNameAttribute($value)
//    {
//        return ucfirst($value);
//    }
//
//    public function business()
//    {
//        return $this->hasMany(Business::class);
//    }
//
//
//    public function order()
//    {
//        return $this->hasMany(Order::class);
//    }
