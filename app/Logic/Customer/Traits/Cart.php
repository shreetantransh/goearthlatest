<?php
/**
 * Created by PhpStorm.
 * User: bay
 * Date: 4/25/2018
 * Time: 6:58 PM
 */

namespace App\Logic\Customer\Traits;

use App\Models\Product;

trait Cart
{
    public function cart()
    {
        return $this->hasOne(\App\Models\Cart::class);
    }

    public function hasProductInCart(Product $product)
    {
        //return $this->cart()->
    }

    public function syncCart(\App\Models\Cart $sessionCart)
    {
        $cartManager = new \App\Logic\Cart();

        if ($sessionCart->items()->count() > 0) {

            $cartItems = $sessionCart->items()->get();

            foreach ($cartItems as $item) {
                $cartManager->addItem(
                    $item->product,
                    $item->qty,
                    $item->options
                );
            }
        }
    }
}