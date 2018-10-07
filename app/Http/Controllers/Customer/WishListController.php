<?php
/**
 * Created by PhpStorm.
 * User: bay
 * Date: 4/19/2018
 * Time: 1:41 PM
 */

namespace App\Http\Controllers\Customer;

use App\Models\Product;

class WishListController extends CustomerController
{
    public function index()
    {
        $wishlist = $this->getCustomer()->wishList()->paginate();
        return view('customer.wishlist.index', compact('wishlist'));
    }

    public function addItem(Product $product)
    {
        try {
            $this->getCustomer()->addToWishList($product);
        } catch (\Exception $exception) {

        }

        return response()->json([
            'success' => true
        ]);
    }

    public function removeItem(Product $product)
    {
        try {
            $this->getCustomer()->removeFromWishList($product);
        } catch (\Exception $exception) {

        }

        return response()->json([
            'success' => true
        ]);
    }
}