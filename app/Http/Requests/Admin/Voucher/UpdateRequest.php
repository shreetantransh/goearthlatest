<?php

namespace App\Http\Requests\Admin\Voucher;

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
            'name' => 'required',
            'code' => 'required',
            'type' => 'required',
            'discount' => 'required|numeric',
            'min_cart_amount' => 'required|numeric',
            'max_discount' => 'required_if:type,2',
            'categories' => 'nullable',
            'product_sku' => 'nullable',
            'valid_from' => 'required|date_format:"d/m/Y"|before:valid_to',
            'valid_to' => 'required|date_format:"d/m/Y"|after:valid_from',
            'is_active' => 'boolean'
        ];
    }
}
