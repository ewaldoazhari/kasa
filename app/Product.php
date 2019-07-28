<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }

    public function ingredient()
    {
        return $this->hasMany(Ingredient::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }


}
