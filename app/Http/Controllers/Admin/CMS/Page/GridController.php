<?php
/**
 * Created by PhpStorm.
 * User: Kamlesh
 * Date: 10/27/2017
 * Time: 4:12 PM
 */

namespace App\Http\Controllers\Admin\CMS\Page;

use App\Models\Page;
use Nayjest\Grids\Components\CsvExport;
use Nayjest\Grids\Components\ColumnsHider;
use Nayjest\Grids\Components\ColumnHeadersRow;
use App\Http\Controllers\Admin\AdminController;
use Nayjest\Grids\Components\Base\RenderableRegistry;

use Nayjest\Grids\Components\ExcelExport;
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
use Nayjest\Grids\ObjectDataRow;

class GridController extends AdminController
{
    public function __invoke()
    {
        $grid = new Grid(
            (new GridConfig)
                ->setName('pages')
                ->setDataProvider(new EloquentDataProvider(Page::query()))
                ->setColumns([
                    (new FieldConfig)
                        ->setName('name')
                        ->setLabel('Name')
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_LIKE)
                        )
                        ->setCallback(function ($val, ObjectDataRow $objectDataRow) {
                            return \Html::linkRoute('admin.cms.page.edit', $val, [$objectDataRow->getSrc()->id]);
                        })
                        ->setSortable(true),
                    (new FieldConfig)
                        ->setName('slug')
                        ->setLabel('Slug')
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_LIKE)
                        )
                        ->setSortable(true),
                    (new FieldConfig())
                        ->setName('is_active')
                        ->setLabel('Publish')
                        ->setSortable(true)
                        ->setCallback(function ($publish) {
                            return $publish == true ? '<i class="material-icons col-green">check_circle</i>' : '<i class="material-icons col-red">error</i>';
                        }),
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
                                ->setFileName("pages.-" . date('Y-m-d') . "-" . microtime()),
                            (new ExcelExport())
                                ->setFileName("pages.-" . date('Y-m-d') . "-" . microtime()),
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
        return view('admin.cms.page.grid', compact('grid'));
    }
}