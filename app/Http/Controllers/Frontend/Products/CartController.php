<?php

namespace App\Http\Controllers\Frontend\Products;

use App\Http\Requests\Frontend\Product\Cart\AddReaquest;
use App\Http\Requests\Frontend\Product\Cart\UpdateRequest;
use App\Models\Product;
use App\Http\Controllers\Controller;
use \cart;


class CartController extends Controller
{
    public function add(AddReaquest $request)
    {
        $product = Product::FindOrFail($request->product_id);

        $cart = app('cart');

        $cart->addItem([
            'product_id' => $product->id,
            'unit_price' => $product->getFinalPrice(FALSE),
            'quantity' => $request->quantity,
            'name' => $product->getName()
        ]);

        return redirect()->back()->with($this->setMessage('Product successfully added to cart.', self::MESSAGE_SUCCESS));
    }

    public function delete($id)
    {
        $cart = app('cart');

        $item = $cart->items()->where('id', $id)->FirstOrFail();

        $cart->removeItem([
            'id' => $item->id
        ]);

        return redirect()->back()->with($this->setMessage('Product successfully deleted to cart.', self::MESSAGE_SUCCESS));
    }

    public function update(UpdateRequest $request)
    {
        $cart = app('cart');

        $item = $cart->items()->where('id', $request->item)->FirstOrFail();

        $cart->updateItem([
            'id' => $item->id
        ], [
            'quantity' => $request->quantity
        ]);

        return redirect()->back()->with($this->setMessage('Product successfully updated to cart.', self::MESSAGE_SUCCESS));
    }
}
