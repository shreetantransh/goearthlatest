<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'qty',
        'options'
    ];

    protected $casts = [
        'options' => 'array'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getProductSubTotal()
    {
        return ($this->product->getFinalPrice() * $this->qty);
    }

    public function getProductFormattedTotal()
    {
        return '<i class="fa fa-inr" aria-hidden="true"></i>' . number_format($this->getProductSubTotal());
    }
}
