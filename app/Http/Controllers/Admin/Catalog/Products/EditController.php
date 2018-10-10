<?php

namespace App\Http\Controllers\Admin\Catalog\Products;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class EditController extends AdminController
{
    public function showForm(Product $product)
    {

            $categories = Category::active()->get();

            return view('admin.catalog.products.tab.product', compact('product', 'categories'));

    }


    public function save(Product $product, Request $request)
    {
        $validate = $this->crateValidation($product);

        $validate['quantity'] = 'required_if:manage_stock,1';
        $validate['stock_alert'] = 'required_if:manage_stock,1';

        $this->validate($request, $validate);

        $attributeCodes = $product->attributeSet->attributes()->pluck('code')->toArray();

        /* Save Product Attributes */
        foreach ($request->only($attributeCodes) as $code => $value) {
            $product->setData($code, $value);
        }

        /* Update Product Images */
        if ($request->input('images') && is_array($request->input('images'))) {
            $productImages = ProductImage::whereIn('id', $request->input('images'))->get();
            $product->images()->saveMany($productImages);
        }

        /* Update product images attributes or delete if required */
        if ($request->input('image') && is_array($request->input('image'))) {
            foreach ($request->input('image') as $image) {

                if ($productImage = $product->images()->find($image['image'])) {

                    if (!empty($image['remove'])) {
                        $productImage->delete();
                        continue;
                    }

                    $productImage->update(collect($image)->only('label', 'sequence')->toArray());
                }
            }
        }

        $product->save();
        $product->categories()->sync($request->category);

        $product->stock()->updateOrCreate(['product_id' => $product->id], [
            'manage_stock' => $request->manage_stock ?: 0,
            'quantity' => $request->quantity,
            'stock_alert' => $request->stock_alert,
            'stock_availability' => $request->stock_availability ?: 0
        ]);

        if($request->redirect_url)
        {
           return redirect($request->redirect_url)->with($this->setMessage('Product has been saved.', self::MESSAGE_SUCCESS));
        }

        return redirect()->back()->with($this->setMessage('Product has been saved.', self::MESSAGE_SUCCESS));
    }


    protected function crateValidation($product)
    {
        $validate = [];

        $groups = $product->attributeSet->groups()->get();

        foreach ($groups as $group) {
            if ($group->attributes()->count()) {
                foreach ($group->attributes()->get() as $attribute) {
                    $validate[$attribute->code] = ($attribute->is_required ? 'required|' : 'nullable|') . validationType($attribute->type);
                }
            }
        }

        return $validate;
    }

    public function uploadImage(Product $product, Request $request)
    {
        $validation = Validator::make($request->all(), [
            'file' => 'required|image|max:5000'
        ]);

        if ($validation->fails()) {
            return response($validation->errors()->first(), 422);
        }

        $imagePath = $request->file('file')->store(ProductImage::UPLOAD_DIR);

        $productImage = $product->images()->create([
            'label' => $request->file('file')->getClientOriginalName(),
            'image' => $imagePath,
            'sequence' => 0
        ]);

        return response()->json($productImage->toArray(), 200);
    }

}
