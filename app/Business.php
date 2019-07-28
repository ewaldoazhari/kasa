<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable=['user_id','business_name','business_category_id','description','office_address',
    'city','phone'];

    public function business_category()
    {
        return $this->belongsTo(Business_category::class);
    }
}
