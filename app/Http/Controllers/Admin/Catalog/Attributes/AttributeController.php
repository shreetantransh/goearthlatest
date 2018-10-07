<?php

namespace App\Http\Controllers\Admin\Catalog\Attributes;

use App\Http\Requests\Admin\CreateAttribute;
use App\Http\Requests\Admin\UpdateAttribute;
use App\Models\Attribute;
use App\Models\AttributeOption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
use Nayjest\Grids\EloquentDataProvider;
use Nayjest\Grids\FieldConfig;
use Nayjest\Grids\FilterConfig;
use Nayjest\Grids\Grid;
use Nayjest\Grids\GridConfig;
use Nayjest\Grids\ObjectDataRow;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grid = new Grid(
            (new GridConfig)
                ->setName('attribute')
                ->setDataProvider(new EloquentDataProvider(Attribute::query()))
                ->setColumns([
                    (new FieldConfig)
                        ->setName('label')
                        ->setLabel('Label')
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_LIKE)
                        )
                        ->setCallback(function ($val, ObjectDataRow $objectDataRow) {
                            return \Html::linkRoute('admin.catalog.attributes.attribute.edit', $val, [$objectDataRow->getSrc()->id]);
                        })
                        ->setSortable(true),
                    (new FieldConfig)
                        ->setName('code')
                        ->setLabel('Code')
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_LIKE)
                        )
                        ->setCallback(function ($val, ObjectDataRow $objectDataRow) {
                            return $val;
                        })
                        ->setSortable(true),
                    (new FieldConfig)
                        ->setName('sequence')
                        ->setLabel('Sequence')
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
        return view('admin.catalog.attribute.grid', compact('grid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attribute = new Attribute();

        $attribute->sequence = Attribute::count() + 1;

        return view('admin.catalog.attribute.create', compact('attribute'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAttribute $request)
    {
        $attribute = Attribute::create($request->all());

        if ($attribute->hasMultiOptions()) {

            $attributeValues = collect();

            foreach ($request->input('option_value') as $key => $optionValue) {

                $attributeValue = $attribute->options()->firstOrNew(['option_value' => $optionValue]);
                $attributeValue->option_sequence = $request->input('option_sequence')[$key] ?: 0;

                $attributeValues->push($attributeValue);
            }
        }


        return redirect()->route('admin.catalog.attributes.attribute.edit', $attribute->id)->with($this->setMessage('Attribute successfully created.', self::MESSAGE_SUCCESS));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attribute = Attribute::findOrFail($id);
        return view('admin.catalog.attribute.create', compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAttribute $request, $id)
    {
        $attribute = Attribute::findOrFail($id);

        $attribute->update($request->all());

        if ($attribute->hasMultiOptions()) {

            $attributeValues = collect();

            foreach ($request->input('option_value') as $key => $optionValue) {

                $attributeValue = $attribute->options()->firstOrNew(['option_value' => $optionValue]);
                $attributeValue->option_sequence = $request->input('option_sequence')[$key] ?: 0;
                $attributeValue->save();

                $attributeValues->push($attributeValue);
            }

            $attribute->options()->whereNotIn('id', $attributeValues->pluck('id'))->delete();
        }
        return redirect()->back()->with($this->setMessage('Attribute successfully updated.', self::MESSAGE_SUCCESS));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Attribute::findOrFail($id)->delete();
        return redirect()->route('admin.catalog.attributes.attribute.index')->with($this->setMessage('Attribute successfully deleted.', self::MESSAGE_SUCCESS));
    }
}
