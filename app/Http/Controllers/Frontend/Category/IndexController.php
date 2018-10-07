<?php

namespace App\Http\Controllers\Frontend\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Logic\Catalog\Category\LayeredNavigation;
use App\Http\Controllers\Frontend\FrontendController;

class IndexController extends FrontendController
{
    protected $category;
    protected $productCollection;

    protected $layeredNavigation;

    const DEFAULT_PRODUCTS_PER_PAGE = 15;

    /**
     * IndexController constructor.
     * @param LayeredNavigation $layeredNavigation
     * @internal param Filter $filter
     */
    public function __construct(LayeredNavigation $layeredNavigation)
    {
        parent::__construct();
        $this->layeredNavigation = $layeredNavigation;
    }

    /**
     * @param Category $category
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke(Category $category, Request $request)
    {
        $this->category = $category;

        $this->layeredNavigation->init($category);

        $this->loadProducts();
        $this->applyFilters();

        if ($request->expectsJson()) {

            $products = $this->productCollection->paginate(self::DEFAULT_PRODUCTS_PER_PAGE);

            $htmlGrid = view('catalog.category.partial.grid-product', [
                'productCollection' => $products,
                'category' => $category,
            ])->render();

            $htmlList = view('catalog.category.partial.list', [
                'productCollection' => $products,
                'category' => $category,
            ])->render();

            $responseData = $products->toArray();
            $responseData['grid'] = $htmlGrid;
            $responseData['list'] = $htmlList;

            unset($responseData['data']);

            return $responseData;
        }

        $categories = Category::active()->addToMenu()->get();

        return view('catalog.category.index', [
            'productCollection' => $this->productCollection->paginate(self::DEFAULT_PRODUCTS_PER_PAGE),
            'category' => $category,
            'sortables' => $this->layeredNavigation->getSortableAttributes(),
            'filterHtml' => $this->layeredNavigation->getFiltersHtml(),
            'categories' => $categories

        ]);
    }

    private function loadProducts()
    {
        $this->productCollection = $this->category->products()
            ->frontend()
            ->setRelationship()
            ->addAttributeToSelect(['name', 'price', 'special_price'])
            ->with('images');
    }

    public function applyFilters()
    {
        $filterInputs = \request('filter');

        if (!$filterInputs) {
            return;
        }

        foreach ($filterInputs as $attributeCode => $filtarableValueArr) {
            $this->productCollection = $this->productCollection->addAttributeToFilter($attributeCode, 'IN', $filtarableValueArr);
        }
    }
}
