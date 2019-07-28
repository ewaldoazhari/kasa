<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;

//class Employee extends Model
//{
//  class User extends Authenticatable
//}

class Employee extends Authenticatable
{
    use Notifiable, HasRoles, HasApiTokens;

    protected $guard_name = 'web';

    protected $fillable = [
        'outlet_id','name', 'email', 'password', 'status',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }

    public function setPasswordAttribute($password)
    {
       $this->attributes['password'] = bcrypt($password);
    }
}
