<?php
/**
 * Created by PhpStorm.
 * Customer: bay
 * Date: 4/9/2018
 * Time: 4:50 PM
 */

namespace App\Logic;

use App\Models\Customer;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Cart as CartModel;
use App\Models\Voucher;
use function MongoDB\BSON\toJSON;

class Cart
{
    protected $sessionId;

    /**
     * @param null $sessionId
     */
    public function setSessionId($sessionId = null)
    {
        $this->sessionId = $sessionId;
    }

    private function getSessionId()
    {
        return session()->getId();
    }

    /**
     * @return \App\Models\Cart
     */
    public function getCart()
    {
        if (auth('customer')->check()) {
            return CartModel::firstOrCreate(['customer_id' => auth('customer')->user()->id]);
        }

        return $this->getSessionCart($this->getSessionId());
    }

    public function getSessionCart($sessionId)
    {
        return CartModel::firstOrCreate(['session_id' => $sessionId]);
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return (bool)$this->getCart()->items()->count();
    }

    /**
     * @param Product $product
     * @param $qty
     * @param array $options
     * @return CartItem|\Illuminate\Database\Eloquent\Model|null|object|static
     * @throws \Exception
     */
    public function addItem(Product $product, $qty, $options = [])
    {
        $qty || $qty = 1;
        $options || $options = [];

        if (!$product->isInStock()) {
            throw new \Exception('The product is out of stock.');
        }

        if (!$product->hasStock($qty)) {
            throw new \Exception('The selected quantity is not available in stock.');
        }

        $itemsInstance = $this->getCart()->items();

        if ($cartItem = $itemsInstance->where('product_id', $product->id)->first()) {
            $cartItem->qty = $cartItem->qty + $qty;
            $cartItem->options = $options;
            $cartItem->save();
        } else {

            $cartItem = $itemsInstance->create([
                'qty' => $qty,
                'options' => $options
            ]);

            $cartItem->product()->associate($product)->save();
        }

        return $cartItem;
    }

    public function itemsCount()
    {
        return $this->getCart()->items()->count();
    }

    public function updateItem(CartItem $cartItem, $attributes = [])
    {

    }

    public function removeItem(CartItem $cartItem)
    {
        $cartItem->delete();
    }

    public function getSubTotal($formatted = false, $deductedDiscount = false)
    {
        $cartItems = $this->getCart()->items()->get();
        $subTotal = 0;

        foreach ($cartItems as $item) {
            $subTotal+= ($item->product->getFinalPrice() * $item->qty) + optional($item->lens)->getFinalPrice();
        }

        return $subTotal - (($this->getDiscount() && $deductedDiscount == true) ? $this->getDiscount() : 0);

    }

    public function grandTotal($formatted = false, $deductedDiscount = false)
    {
        $grandTotal = $this->getSubTotal(false, $deductedDiscount);

        if ($formatted) {
            return '<i class="fa fa-inr"></i>' . number_format($grandTotal);
        }

        return $grandTotal;
    }

    public function getTax()
    {
        $cartItems = $this->getCart()->items()->get();
        $total_tax_amt=0;
        $total_tax_percentage=0;
        foreach ($cartItems as $item) {
            //use tax % instead hard code value 1
            $total_tax_amt+= ($item->product->getFinalPrice() * 1)/100;
            $total_tax_percentage+=1;
        }

        return array('tax_amt'=>$total_tax_amt,'tax_percentage'=>$total_tax_percentage);
    }



    public function addVoucherToCart(Voucher $voucher, array $response)
    {
       return $this->getCart()->update(['voucher' => $voucher->code, 'discount' => $response['discount']]);
    }

    public function getDiscount($formatted = false)
    {
        $discount = $this->getCart()->discount ?: 0;

        if ($formatted) {
            return '<i class="fa fa-inr"></i>' . number_format($discount);
        }

        return $discount;
    }




    public function getVoucherCode()
    {
        return $this->getCart()->voucher;
    }

    public function removeVoucher()
    {
        $this->getCart()->update(['voucher' => NULL, 'discount' => NULL]);
        return ['status' => false, 'message' => 'Voucher successfully removed.'];
    }


    //function for get cart items in dropdown in header bar
    public function getCartItems(){
        return $this->getCart()->items()->with('product')->get();
    }

}