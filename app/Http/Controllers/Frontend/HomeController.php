<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use App\Models\Testimonial;
use Carbon\Carbon;
use App\Models\Banner;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends FrontendController
{
    public function __invoke()
    {
        $this->setBanners();
        $this->setNewArrivals();
        $categories = Category::Active()->limit(6)->get();

        $testimonials = Testimonial::active()->sequenced()->get();

        return view('template.html.home', compact('banners', 'categories', 'testimonials'));
    }

    private function setBanners()
    {
        $banners = Banner::active()->get();
        view()->share('banners', $banners);
    }

    private function setNewArrivals()
    {
        $newArrivals = Product::setRelationship()->addAttributeToSelect([
            'name',
            'price',
            'new_from',
            'new_to'
        ])
            ->frontend()
            ->addAttributeToFilter('new_from', '<=', Carbon::now()->format('Y-m-d'))
            ->addAttributeToFilter('new_to', '>=', Carbon::now()->format('Y-m-d'))
            ->limit(10)->get();

        view()->share('newArrivals', $newArrivals);
    }

    protected function getProductsByCategories($category = null)
    {

        return Product::frontend()->setRelationship()->whereHas('categories', function ($query) use ($category) {
            return $query->where('categories.slug', $category);
        })->limit(8)->get()->chunk(2);

    }

    protected function getNewProducts()
    {
        return Product::frontend()->setRelationship()->orderBy('products.created_at', 'desc')->limit(12)->get()->chunk(3);
    }

    protected function getBestSeller()
    {
        return Product::frontend()->setRelationship()->whereHas('orderProducts')->withCount('orderProducts')->orderBy('order_products_count', 'desc')->limit(12)->get()->chunk(3);
    }

    public function homeCategoryProducts($method, Request $request)
    {
        if ($request->ajax()) {

            $method = 'get' . $method;

            $category = Category::active()->where('slug', str_replace("get","",$method))->first();

            if (method_exists($this, $method)) {

                $productCollection = $this->$method();

                if ($productCollection && $productCollection->count()) {

                    $view = view('template.html.home.products-chunk', compact('productCollection', 'category', 'method'))->render();

                    return response()->json(['view' => $view]);
                }

            } else {
                $productCollection = $this->getProductsByCategories(str_replace("get","",$method));
            }

            if ($productCollection && $productCollection->count()) {

                $view = view('template.html.home.products', compact('productCollection', 'category'))->render();

                return response()->json(['view' => $view]);
            }
        }

    }
}
