<?php

namespace App\Http\Controllers\Customer;

use App\Logic\Cart;
use App\Models\Product;
use App\Models\Voucher;
use Illuminate\Http\Request;

class CartController extends CustomerController
{
    public $cart_products;
    public $cart_apply_product;

    public function getCartInfo()
    {
        return response()->json([
            'success' => true,
            'itemsCount' => $this->cart->itemsCount()
        ]);
    }

    public function update(Request $request)
    {
        $cart = $this->cart->getCart();

        if (is_array($request->input('qty'))) {

            foreach ($request->input('qty') as $itemId => $qty) {

                if ($cart->items()->where('id', $itemId)->count() > 0 && $qty > 0) {

                    $cart->items()->find($itemId)->update([
                        'qty' => $qty
                    ]);

                }
            }
        }

        $cartItems = $this->cart->getCart()
            ->items()
            ->with('product')
            ->get();

        $excludeContainer = true;

        return view('customer.cart.index', compact('cartItems', 'excludeContainer'));
    }

    public function getCart()
    {
        $cartItems = $this->cart->getCart()
            ->items()
            ->with('product')
            ->get();

        return view('customer.cart.index', compact('cartItems'));
    }

    public function addProduct(Request $request)
    {
        try {

            $product = Product::frontend()->setRelationship()->find($request->input('product_id'));

            $item = $this->cart->addItem(
                $product,
                $request->input('qty'),
                $request->input('options')
            );

            return response()->json([
                'success' => true,
                'message' => 'Product has been successfully added in your cart.',
                'itemsCount' => $this->cart->itemsCount(),
                'cartItem' => $item->id
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }

    public function deleteItem(Request $request)
    {
        try {

            $itemId = $request->input('product_id');

            $cart = $this->cart->getCart();


            if ($cartItem = $cart->items()->find($itemId)) {

                $this->cart->removeItem($cartItem);

            }

            $cartItems = $this->cart->getCart()
                ->items()
                ->with('product')
                ->get();

            $excludeContainer = true;

            return view('customer.cart.index', compact('cartItems', 'excludeContainer'));

        } catch (\Exception $exception) {

            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);

        }
    }


    public function getCheckoutCart(Request $request)
    {
        $cartItems = $this->cart->getCart()
            ->items()
            ->with('product')
            ->get();

        $message = $request->message;

        return view('checkout.cart', compact('cartItems', 'message'));
    }

    public function applyVoucher(Request $request)
    {
        if ($voucher = Voucher::active()->where('code', $request->voucher)->first()) {


            if($this->cart->getVoucherCode())
                return $this->cart->removeVoucher();


            $cartItems = $this->cart->getCart()
                ->items()
                ->with(['product' => function ($query) {
                    return $query->with('categories');
                }])
                ->get();

           $cartPrice =  $this->getCartItemPrice($voucher, $cartItems);

           if(!$cartPrice)
           {
              return response()->json([
                   'error' => true,
                   'message' => 'This voucher code is invalid or may expired.'
               ]);
           }

           $response = $voucher->calculateDiscount($cartPrice);

           return $this->addVoucherToCart($response, $cartPrice, $voucher);

        } else {
            return response()->json(['status' => false, 'message' => 'Invalid voucher.']);
        }
    }

    protected function addVoucherToCart($response, $cartPrice, $voucher)
    {
       if($response['error'])
       {
           if($this->cart_products)
           {
               return response()->json([
                   'error' => true,
                   'message' => 'Un-sufficient cart amount of product - ' . $this->cart_apply_product . ' required minimum amount <i class="fa fa-inr"></i> ' . $voucher->min_cart_amount
               ]);
           }

           return response()->json([
               'error' => true,
               'message' => 'Un-sufficient cart amount for product - required minimum amount <i class="fa fa-inr"></i> ' . $voucher->min_cart_amount
           ]);

       }

       $this->cart->addVoucherToCart($voucher, $response);

       return response()->json([
           'error' => false,
           'message' => 'Voucher has been successfully applied'
       ]);


    }

    protected function getCartItemPrice(Voucher $voucher, $cartItem)
    {

        $pricing = [];

        if ($categories = $voucher->hasCategory()) {

            foreach ($cartItem as $item) {

                $product = $item->product()->first();

                if ($product->categories()->get()->contains(implode(', ', $categories)))
                {
                    $pricing[] = $item->getProductSubTotal();
                    $this->cart_products[] = $product->getName();

                }else
                {
                    $this->cart_apply_product .= $product->getName() . ', ';
                }


            }

            return array_sum($pricing);

        }

        if ($sku = $voucher->hasProduct()) {

            foreach ($cartItem as $item) {

                $product = $item->product()->first();

                if ($product->getSku() == $sku)
                {
                    $pricing[] = $item->getProductSubTotal();
                    $this->cart_products[] = $product->getName();
                }else{
                    $this->cart_apply_product .= $product->getName() . ', ';
                }


            }

            return array_sum($pricing);
        }

        return $cartItem->grandTotal(false);
    }


}
