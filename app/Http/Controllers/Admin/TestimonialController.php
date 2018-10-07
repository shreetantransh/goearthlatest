<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Testimonial\CreateRequest;
use App\Models\Testimonial;
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

class TestimonialController extends Controller
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
                ->setName('testimonial')
                ->setDataProvider(new EloquentDataProvider(Testimonial::query()))
                ->setColumns([
                    (new FieldConfig)
                        ->setName('name')
                        ->setLabel('Name')
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_LIKE)
                        )
                        ->setCallback(function ($val, ObjectDataRow $objectDataRow) {
                            return \Html::linkRoute('admin.testimonial.edit', $val, [$objectDataRow->getSrc()->id]);
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
                                ->setFileName("voucher-" . date('Y-m-d') . "-" . microtime()),
                            (new ExcelExport())
                                ->setFileName("voucher.-" . date('Y-m-d') . "-" . microtime()),
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

        return view('admin.testimonial.index', compact('grid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $testimonial = new Testimonial();

        $testimonial->sequence = Testimonial::count() + 1;

        return view('admin.testimonial.create', compact('testimonial'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $values = $request->all();

        $values['status'] = $request->status ?: false;

        if($request->hasFile('image'))
        {
            $path = $request->image->store(Testimonial::IMAGE_UPLOAD_PATH);

            $values['image'] = $path;

        }

        $testimonial = Testimonial::create($values);

        return redirect()->route('admin.testimonial.edit', $testimonial->id)->with($this->setMessage('Testimonial successfully saved', self::MESSAGE_SUCCESS));
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
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonial.create', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateRequest $request, Testimonial $testimonial)
    {
        $values = $request->all();

        $values['status'] = $request->status ?: false;

        if($request->hasFile('image'))
        {
            $path = $request->image->store(Testimonial::IMAGE_UPLOAD_PATH);

            $values['image'] = $path;

        }

        $testimonial->update($values);

        return redirect()->route('admin.testimonial.edit', $testimonial->id)->with($this->setMessage('Testimonial successfully updated', self::MESSAGE_SUCCESS));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->deleteImage();

        $testimonial->delete();

        return redirect()->route('admin.testimonial.index')->with($this->setMessage('Testimonial successfully deleted.', self::MESSAGE_SUCCESS));
    }
}
