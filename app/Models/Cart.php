<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'session_id',
        'product_id',
        'qty',
        'customer_id',
        'discount',
        'voucher'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'cart_items')->withPivot('qty', 'options');
    }
}
