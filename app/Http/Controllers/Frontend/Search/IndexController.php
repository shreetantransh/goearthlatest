<?php

namespace App\Http\Controllers\Frontend\Search;

use App\Http\Controllers\Frontend\FrontendController;
use App\Logic\Catalog\Category\LayeredNavigation;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends FrontendController
{
    protected $products;

    public function __construct(LayeredNavigation $layeredNavigation)
    {
        parent::__construct();

        $this->layeredNavigation = $layeredNavigation;

        $this->products = Product::setRelationship()->frontend()->addAttributeToSelect(['name', 'price', 'special_price']);
        $this->applyFilter();
    }

    public function __invoke()
    {

        $productCollection =  $this->products->paginate(12);

        return view("frontend.search.index", compact('productCollection'));
    }

    protected function applyFilter()
    {

       $keywords = request('term');

       $this->products->addAttributeToFilter('name', 'LIKE', "%{$keywords}%");

    }



}
