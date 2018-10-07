<?php

namespace App\Http\Controllers\Admin\Catalog\Attributes;

use App\Models\AttributeSet;
use App\Models\AttributeSetGroup;
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

class AttributeGroupController extends Controller
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
                ->setName('attribute-group')
                ->setDataProvider(new EloquentDataProvider(AttributeSetGroup::query()))
                ->setColumns([
                    (new FieldConfig)
                        ->setName('name')
                        ->setLabel('Name')
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_LIKE)
                        )
                        ->setCallback(function ($val, ObjectDataRow $objectDataRow) {
                            return \Html::linkRoute('admin.catalog.attributes.attribute-group.edit', $val, [$objectDataRow->getSrc()->id]);
                        })
                        ->setSortable(true),
                    (new FieldConfig)
                        ->setName('set_name')
                        ->setLabel('Set Name')
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_LIKE)
                        )
                        ->setCallback(function ($val, ObjectDataRow $objectDataRow) {
                            return $objectDataRow->getSrc()->attributeSet->name;
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
                                ->setFileName("catalog.attribute-set.-" . date('Y-m-d') . "-" . microtime()),
                            (new ExcelExport())
                                ->setFileName("catalog.attribute-set.-" . date('Y-m-d') . "-" . microtime()),
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
        return view('admin.catalog.attribute-group.grid', compact('grid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attribute_group = new AttributeSetGroup();

        $attribute_sets = AttributeSet::pluck('name', 'id')->toArray();

        return view('admin.catalog.attribute-group.create', compact('attribute_group', 'attribute_sets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'attribute_set_id' => 'required'
        ]);

        $attributeSet = AttributeSet::findOrFail($request->attribute_set_id);

        $attributeSet->groups()->create($request->all());

        return redirect()->back()->with($this->setMessage('Attribute group successfully created.', self::MESSAGE_SUCCESS));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attribute_group = AttributeSetGroup::findOrFail($id);

        $attribute_sets = AttributeSet::pluck('name', 'id')->toArray();

        return view('admin.catalog.attribute-group.create', compact('attribute_group', 'attribute_sets'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'attribute_set_id' => 'required'
        ]);

        $attributeSet = AttributeSet::findOrFail($request->attribute_set_id);

        AttributeSetGroup::find($id)->update($request->all());

        return redirect()->back()->with($this->setMessage('Attribute group successfully updated.', self::MESSAGE_SUCCESS));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AttributeSetGroup::findOrFail($id)->delete();

        return redirect()->route('admin.catalog.attributes.attribute-group.index')->with($this->setMessage('Attribute group successfully deleted.', self::MESSAGE_SUCCESS));

    }
}
