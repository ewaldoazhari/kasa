<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raw_material extends Model
{
    protected $fillable = [
        'outlet_id','raw_material', 'uom', 'stock',
    ];


    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }

    public function ingredient()
    {
        return $this->hasMany(Ingredient::class);
    }
}
