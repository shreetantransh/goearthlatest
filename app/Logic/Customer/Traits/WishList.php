<?php
/**
 * Created by PhpStorm.
 * User: bay
 * Date: 4/19/2018
 * Time: 1:42 PM
 */

namespace App\Logic\Customer\Traits;

use App\Models\Product;
use Carbon\Carbon;

trait WishList
{
    public $wishListTable = 'wish_lists';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function wishList()
    {
        return $this->belongsToMany(Product::class, $this->wishListTable)->withPivot('created_at');
    }

    /**
     * @param Product $product
     * @return bool
     */
    public function isInWishList(Product $product)
    {
        return (bool)$this->wishList()->where('products.id', $product->id)->count();
    }

    /**
     * @param Product $product
     * @throws \Exception
     */
    public function addToWishList(Product $product)
    {
        if ($this->isInWishList($product)) {
            throw new \Exception('The product is already exists in your favourites.');
        }

        return $this->wishList()->attach($product, [
            'created_at' => Carbon::now()
        ]);
    }

    /**
     * @param Product $product
     * @return int
     * @throws \Exception
     */
    public function removeFromWishList(Product $product)
    {
        if (!$this->isInWishList($product)) {
            throw new \Exception('The product does not exists in your favourites.');
        }

        return $this->wishList()->detach($product);
    }
}