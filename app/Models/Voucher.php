<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'name',
        'code',
        'type',
        'discount',
        'min_cart_amount',
        'max_discount',
        'categories',
        'product_sku',
        'valid_from',
        'valid_to',
        'is_active'
    ];


    protected $dates = [
        'valid_from',
        'valid_to'
    ];

    protected $casts = [
        'categories' => 'array'
    ];

    public function setValidFromAttribute($value)
    {
        $this->attributes['valid_from'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function setValidToAttribute($value)
    {
        $this->attributes['valid_to'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function getValidFromAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getValidToAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function is_valid()
    {
        if(Carbon::now()->between(Carbon::parse($this->getOriginal('valid_from')), Carbon::parse($this->getOriginal('valid_to'))))
        {
            return true;
        }

        return false;
    }

    public function hasProduct()
    {
        return $this->product_sku;
    }

    public function hasCategory()
    {
        $categories = $this->categories;

        if($categories)
        return is_int($categories) ? [$categories] : array_filter($categories);
    }

    public function calculateDiscount(int $cartPrice)
    {
        if($cartPrice < $this->min_cart_amount)
        {
            return ['error' => true];
        }

        if($this->type == 1)
        {
            return ['error' => false, 'discount' => $this->discount];
        }else{

            $discount = ($cartPrice * $this->discount) * 100;

            if($discount > $this->max_discount)
            {
                return ['error' => false, 'discount' => $this->max_discount];
            }

            return ['error' => false, 'discount' => $discount];
        }
    }


}
