<?php

namespace App\Http\Requests\Admin\Catalog\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'required|max:255',
            'description' => '',
            'icon' => 'image',
            'meta_title' => 'required',
            'meta_keywords' => 'max:1000',
            'meta_description' => 'max:2000',
            'is_active' => 'boolean',
            'parent_category' => 'nullable|numeric'
        ];
    }
}
