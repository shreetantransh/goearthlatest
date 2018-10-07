<?php

namespace App\Http\Controllers\Admin\Catalog\Attributes;

use App\Models\Attribute;
use App\Models\AttributeSet;
use App\Models\AttributeSetGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttributeManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attribute_sets = AttributeSet::get();

        $attributes = Attribute::pluck('label', 'id')->toArray();

        return view('admin.catalog.manage-attribute.create', compact('attribute_sets', 'attributes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $attributeSetGroups = AttributeSetGroup::with('attributeSet')->get();

        foreach ($attributeSetGroups as $attributeSetGroup) {

            $attributes = $request->input('attribute_id' . '.' . $attributeSetGroup->id) ?: [];

            $syncAttributes = [];

            foreach ($attributes as $attribute) {
                $syncAttributes[$attribute] = [
                    'attribute_set_id' => $attributeSetGroup->attributeSet->id
                ];
            }

            $attributeSetGroup->attributes()->sync($syncAttributes);
        }

        return redirect()->back()->with($this->setMessage('Attribute successfully saved.', self::MESSAGE_SUCCESS));

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
