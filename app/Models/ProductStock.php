<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    protected $fillable = ['manage_stock', 'quantity', 'stock_alert', 'stock_availability'];
}
