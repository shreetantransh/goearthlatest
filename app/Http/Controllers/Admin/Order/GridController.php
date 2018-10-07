<?php

namespace App\Http\Controllers\Admin\Order;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

class GridController extends Controller
{
    public function __invoke()
    {
        return $this->index();
    }

    public function index()
    {
        $grid = new Grid(
            (new GridConfig)
                ->setName('order')
                ->setDataProvider(new EloquentDataProvider(Order::select('orders.*', 'customers.first_name')->leftJoin('customers', 'orders.customer_id', '=', 'customers.id')->orderBy('orders.id', 'desc')))
                ->setColumns([
                    (new FieldConfig)
                        ->setName('order_id')
                        ->setLabel('Order Id')
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_LIKE)
                        )
                        ->setCallback(function ($val, ObjectDataRow $objectDataRow) {
                            return \Html::linkRoute('admin.order.view', $val, [$objectDataRow->getSrc()->id]);
                        })
                        ->setSortable(true),
                    (new FieldConfig)
                        ->setName('first_name')
                        ->setLabel('Customer Name')
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_LIKE)
                        )
                        ->setCallback(function ($val, ObjectDataRow $objectDataRow) {
                            return  $val;
                        })
                        ->setSortable(true),
                    (new FieldConfig)
                        ->setName('payment_mode')
                        ->setLabel('Payment Mode')
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_LIKE)
                        )
                        ->setCallback(function ($val, ObjectDataRow $objectDataRow) {
                            return strtoupper($val);
                        })
                        ->setSortable(true),
                    (new FieldConfig)
                        ->setName('transaction_id')
                        ->setLabel('Transaction Id')
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_LIKE)
                        )
                        ->setCallback(function ($val, ObjectDataRow $objectDataRow) {
                            return strtoupper($val);
                        })
                        ->setSortable(true),
                    (new FieldConfig)
                        ->setName('is_paid')
                        ->setLabel('Is Paid')
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_LIKE)
                        )
                        ->setCallback(function ($val, ObjectDataRow $objectDataRow) {
                            return $val == true ? 'Yes' : 'No';
                        })
                        ->setSortable(true),
                    (new FieldConfig)
                        ->setName('total')
                        ->setLabel('Total')
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_LIKE)
                        )
                        ->setCallback(function ($val, ObjectDataRow $objectDataRow) {
                            return $val;
                        })
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
                            (new ColumnsHider),
                            (new CsvExport())
                                ->setFileName("banner-" . date('Y-m-d') . "-" . microtime()),
                            (new ExcelExport())
                                ->setFileName("banner.-" . date('Y-m-d') . "-" . microtime()),
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

        return view('admin.order.grid', compact('grid'));
    }
}
