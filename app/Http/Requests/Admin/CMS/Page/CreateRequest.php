<?php

namespace App\Http\Requests\Admin\CMS\Page;

use App\Models\Page;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
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
            'slug' => 'required|unique:pages,slug',
            'content' => '',
            'meta_title' => 'required',
            'meta_keywords' => 'max:1000',
            'meta_description' => 'max:2000',
            'is_active' => 'boolean',
            'template' => [
                'required',
                Rule::in(Page::getPageTemplates()->pluck('value')->toArray())
            ]
        ];
    }
}
