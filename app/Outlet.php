<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
//    protected $guarded = [];

    protected $fillable = ['business_id','photo','outlet','note','address','city','phone_number'];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function employee()
    {
        return $this->hasMany(Employee::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function raw_material()
    {
        return $this->hasMany(Raw_material::class);
    }

    public function ingredient()
    {
        return $this->hasMany(Ingredient::class);
    }



}
