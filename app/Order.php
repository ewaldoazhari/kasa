<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    protected $dates = ['created_at'];

//    public function customer()
//    {
//        return $this->belongsTo(Customer::class);
//    }

//    public function user()
//    {
//        return $this->belongsTo(User::class);
//    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order_detail()
    {
        return $this->hasMany(Order_detail::class);
    }

    public function home()
    {
        return $this->belongsTo(Home::class);
    }
}
