<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'email', 'mobile', 'address', 'street', 'landmark', 'city_id', 'state_id', 'country', 'pincode', 'is_default', 'gender'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
