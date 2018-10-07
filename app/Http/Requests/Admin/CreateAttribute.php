<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateAttribute extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'label' => 'required',
            'code' => 'required|unique:attributes,code',
            'type' => 'required|string',
            'is_required' => 'boolean',
            'is_comparable' => 'boolean',
            'is_searchable' => 'boolean',
            'used_in_product_listing' => 'boolean',
            'used_in_product_detail' => 'boolean',
            'used_in_product_sorting' => 'boolean',
            'sequence' => 'required|numeric',
        ];
    }
}
