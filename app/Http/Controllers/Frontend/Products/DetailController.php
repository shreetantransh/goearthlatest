<?php

namespace App\Http\Controllers\Frontend\Products;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DetailController extends Controller
{
    public function __invoke($slug)
    {
        $product = Product::FindOrFail($slug);

        return view('frontend.product.detail', compact('product'));
    }
}
