<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = [
        'order_id',
        'transaction_id',
        'payment_request_id',
        'sub_total',
        'tax',
        'discount',
        'total',
        'payment_mode',
        'status',
        'is_paid',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function address()
    {
        return $this->hasOne(OrderAddress::class);
    }

    public function orderLogs()
    {
        return $this->hasMany(OrderLog::class);
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products', 'order_id', 'product_id');
    }

    public function getSubTotal()
    {
        return '<i class="fa fa-inr"></i>' . number_format($this->sub_total);
    }

    public function getTotal()
    {
        return '<i class="fa fa-inr"></i>' . number_format($this->total);
    }

    public function getDiscount()
    {
        return '<i class="fa fa-inr"></i>' . number_format($this->discount);
    }

    public function orderStatus()
    {
        return $this->getStatus($this->status);
    }

    protected function getStatus($value)
    {
        $status = [
            0 => 'Pending',
            1 => 'Processing',
            2 => 'Shipped',
            3 => 'Canceled',
            4 => 'Completed'
        ];

        return isset($status[$value]) ? $status[$value] : NULL;

    }

}
