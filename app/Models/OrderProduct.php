<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = [
        'customer_id',
        'product_id',
        'price',
        'quantity',
        'options',
        'sub_total'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
