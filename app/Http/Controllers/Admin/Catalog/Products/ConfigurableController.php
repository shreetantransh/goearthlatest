<?php

namespace App\Http\Controllers\Admin\Catalog\Products;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Grid\CheckAllField;

use Nayjest\Grids\Components\Base\RenderableRegistry;
use Nayjest\Grids\Components\ColumnHeadersRow;
use Nayjest\Grids\Components\FiltersRow;
use Nayjest\Grids\Components\HtmlTag;
use Nayjest\Grids\Components\Laravel5\Pager;
use Nayjest\Grids\Components\OneCellRow;
use Nayjest\Grids\Components\RecordsPerPage;
use Nayjest\Grids\Components\ShowingRecords;
use Nayjest\Grids\Components\TFoot;
use Nayjest\Grids\Components\THead;
use Nayjest\Grids\EloquentDataProvider;
use Nayjest\Grids\FieldConfig;
use Nayjest\Grids\FilterConfig;
use Nayjest\Grids\Grid;
use Nayjest\Grids\GridConfig;
use Nayjest\Grids\IdFieldConfig;

class ConfigurableController extends Controller
{
    public function showForm(Product $product)
    {
        $productCollection = Product::setRelationship()
            ->addAttributeToFilter('status', '=', 'Enabled')
            ->addAttributeToSelect(['name', 'price', 'sku'])
            ->where('products.type', 'product_type_simple')
            ->orderBy('products.created_at', 'desc');

        $configured_product = $product->configurable()->get();


        $grid = (new Grid(
            (new GridConfig)
                ->setName('configurable-products')
                ->setDataProvider(new EloquentDataProvider($productCollection))
                ->setColumns([
                    (new CheckAllField($product->configurable()->pluck('products.id')->toArray())),
                    (new IdFieldConfig())
                        ->setLabel('#'),
                    (new FieldConfig)
                        ->setName('name')
                        ->setLabel('Name')
                        ->addFilter(
                            (new FilterConfig())
                                ->setOperator(FilterConfig::OPERATOR_LIKE)
                                ->setFilteringFunc(function ($value, EloquentDataProvider $provider) {
                                    $provider->getBuilder()->addAttributeToFilter('name', 'LIKE', "%{$value}%");
                                })
                        )
                        ->setSortable(true),
                    (new FieldConfig)
                        ->setName('sku')
                        ->addFilter(
                            (new FilterConfig())
                                ->setOperator(FilterConfig::OPERATOR_LIKE)
                                ->setFilteringFunc(function ($value, EloquentDataProvider $provider) {
                                    $provider->getBuilder()->addAttributeToFilter('sku', '=', $value);
                                })
                        )
                        ->setLabel('SKU')
                        ->setSortable(true),
                    (new FieldConfig)
                        ->setName('price')
                        ->setLabel('Price')
                        ->addFilter(
                            (new FilterConfig())
                                ->setOperator(FilterConfig::OPERATOR_LIKE)
                                ->setFilteringFunc(function ($value, EloquentDataProvider $provider) {
                                    $provider->getBuilder()->addAttributeToFilter('Price', '=', $value);
                                })
                        )
                        ->setSortable(true),
                    (new FieldConfig())
                        ->setName('updated_at')
                        ->setLabel('Updated At')
                        ->setCallback(function ($value) {
                            return $value->format('F j, Y') . '<br /><abbr>' . $value->format('h:i A') . '</abbr>';
                        })
                        ->setSortable(true),
                    (new FieldConfig())
                        ->setName('created_at')
                        ->setLabel('Created At')
                        ->setCallback(function ($value) {
                            return $value->format('F j, Y') . '<br /><abbr>' . $value->format('h:i A') . '</abbr>';
                        })
                        ->setSortable(true)
                ])
                ->setComponents([
                    (new THead)
                        ->setComponents([
                            (new FiltersRow),
                            (new ColumnHeadersRow),
                            (new RecordsPerPage),
                            //(new ColumnsHider),
                            (new HtmlTag)
                                ->setContent('<i class="material-icons">search</i>')
                                ->setTagName('button')
                                ->setRenderSection(RenderableRegistry::SECTION_END)
                                ->setAttributes([
                                    'class' => 'btn btn-primary'
                                ])
                        ]),
                    (new TFoot)->setComponents([
                        (new OneCellRow)->setComponents([
                            (new Pager()),
                            (new ShowingRecords()),
                        ])
                    ])
                ])
        ))->render();

        return view('admin.catalog.products.tab.configurable-product', compact(
            'product',
            'grid',
            'configured_product'
        ));
    }

    public function save(Product $product, Request $request)
    {
        $request->validate([
            'grid_items' => 'array',
            'grid_items.*' => 'required|numeric'
        ]);


        $product->configurable()->sync($request->input('grid_items'));

        return redirect()->back()->with($this->setMessage('Configurable Product has been successfully updated.', self::MESSAGE_SUCCESS));
    }
}
