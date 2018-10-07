<?php

namespace App\Http\Requests\Banner;

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
            'title'     => 'required|max:255"',
            'url'       => 'nullable|url',
            'button_title' => 'nullable|string',
            'content'   => 'nullable|max:1000',
            'banner_image'     => 'nullable|image',
            'sequence'  => 'required|numeric',
            'is_active' => 'boolean'
        ];
    }
}
