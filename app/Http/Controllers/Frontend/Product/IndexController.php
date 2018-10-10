<?php
/**
 * Created by PhpStorm.
 * User: bay
 * Date: 3/14/2018
 * Time: 6:08 PM
 */

namespace App\Http\Controllers\Frontend\Product;

use App\Http\Controllers\Frontend\FrontendController;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;

class IndexController extends FrontendController
{
    public function __invoke(Category $category)
    {
        $product = Product::frontend()->with('attributes', 'images')
            ->setRelationship()
            ->addSlugFilter(request('product'))
            ->firstOrFail();

        $relatedProducts = $product->related()->setRelationship()->addAttributeToSelect([
            'name',
        ])->limit(20)->get();

        $categories = Category::active()->addToMenu()->get();

        return view('catalog.product.index', compact('product', 'relatedProducts', 'category', 'categories'));
    }
}