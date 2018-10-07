<?php
/**
 * Created by PhpStorm.
 * Customer: bay
 * Date: 2/8/2018
 * Time: 1:07 PM
 */

namespace App\Http\Controllers\Admin\Catalog\Products;

use App\Http\Controllers\Admin\AdminController;


use App\Models\Attribute;
use App\Models\Product;
use Nayjest\Builder\Builder;
use Nayjest\Grids\Components\Base\RenderableRegistry;
use Nayjest\Grids\Components\ColumnHeadersRow;
use Nayjest\Grids\Components\ColumnsHider;
use Nayjest\Grids\Components\CsvExport;
use Nayjest\Grids\Components\ExcelExport;
use Nayjest\Grids\Components\FiltersRow;
use Nayjest\Grids\Components\HtmlTag;
use Nayjest\Grids\Components\Laravel5\Pager;
use Nayjest\Grids\Components\OneCellRow;
use Nayjest\Grids\Components\RecordsPerPage;
use Nayjest\Grids\Components\ShowingRecords;
use Nayjest\Grids\Components\TFoot;
use Nayjest\Grids\Components\THead;
use Nayjest\Grids\DataRow;
use Nayjest\Grids\EloquentDataProvider;
use Nayjest\Grids\FieldConfig;
use Nayjest\Grids\FilterConfig;
use Nayjest\Grids\Grid;
use Nayjest\Grids\GridConfig;
use Nayjest\Grids\ObjectDataRow;
use Nayjest\Grids\SelectFilterConfig;

class GridController extends AdminController
{
    public function __invoke()
    {

        $grid = new Grid(
            (new GridConfig)
                ->setName('attribute')
                ->setDataProvider(new EloquentDataProvider(Product::setRelationship()->addAttributeToSelect(['name', 'price', 'special_price', 'status'])->orderBy('products.created_at', 'desc')))
                ->setColumns([
                    (new FieldConfig)
                        ->setName('name')
                        ->setLabel('Name')
                        ->setCallback(function ($val, ObjectDataRow $objectDataRow) {
                            return \Html::linkRoute('admin.catalog.product.tab.product', $objectDataRow->getSrc()->getName(), [$objectDataRow->getSrc()->id]);
                        })
                        ->addFilter(
                            (new FilterConfig())
                                ->setOperator(FilterConfig::OPERATOR_LIKE)
                                ->setFilteringFunc(function ($value, EloquentDataProvider $provider) {
                                    $provider->getBuilder()->addAttributeToFilter('name', 'LIKE', "%{$value}%");
                                })
                        )
                        ->setSortable(true),
                    (new FieldConfig)
                        ->setName('price')
                        ->setLabel('Price')
                        ->setSortable(true)
                        ->setCallback(function ($val, $row) {
                            return $row->getSrc()->getFormattedPrice();
                        })
                        ->addFilter(
                            (new FilterConfig())
                                ->setOperator(FilterConfig::OPERATOR_LIKE)
                                ->setFilteringFunc(function ($value, EloquentDataProvider $provider) {
                                    $provider->getBuilder()->addAttributeToFilter('price', '=', $value);
                                })
                        ),
                    (new FieldConfig)
                        ->setName('type')
                        ->setLabel('Type')
                        ->setSortable(true)
                        ->setCallback(function ($val) {
                            return $val == 'product_type_simple' ? 'Simple' : 'Configurable';
                        })
                        ->addFilter(
                            (new SelectFilterConfig())
                                ->setName('products.type')
                                ->setOptions([
                                    'product_type_simple' => 'Simple',
                                    'product_type_configurable' => 'Configurable'
                                ])
                        ),
                    (new FieldConfig)
                        ->setName('status')
                        ->setLabel('Status')
                        ->setSortable(true)
                        ->addFilter(
                            (new SelectFilterConfig())
                                ->setOptions(Attribute::where('code', 'status')->first()->options()->pluck('option_value', 'option_value')->toArray())
                                ->setOperator(FilterConfig::OPERATOR_LIKE)
                                ->setFilteringFunc(function ($value, EloquentDataProvider $provider) {
                                    $provider->getBuilder()->addAttributeToFilter('status', '=', $value);
                                })
                        ),
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
                            (new ColumnsHider),
                            (new CsvExport())
                                ->setFileName("catalog.attributes-" . date('Y-m-d') . "-" . microtime()),
                            (new ExcelExport())
                                ->setFileName("catalog.attribute.-" . date('Y-m-d') . "-" . microtime()),
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
        );
        return view('admin.catalog.products.grid', compact('grid'));
    }
}