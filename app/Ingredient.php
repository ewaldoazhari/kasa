<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = [
        'outlet_id','product_id','raw_material_id', 'stock_used',
    ];

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function raw_material()
    {
        return $this->belongsTo(Raw_material::class);
    }
}
