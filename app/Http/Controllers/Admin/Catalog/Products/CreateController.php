<?php

namespace App\Http\Controllers\Admin\Catalog\Products;

use App\Models\AttributeSet;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    public function showForm()
    {
        $attribute_sets = AttributeSet::pluck('name', 'id');
        $product = New Product();

        return view('admin.catalog.products.create', compact('product', 'attribute_sets'));
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'attribute_set_id' => 'required|numeric|exists:attributes,id',
            'type' => 'required'
        ]);


        $product = Product::create($request->all());

        return redirect()->route('admin.catalog.product.tab.product', $product->id);
    }
}
