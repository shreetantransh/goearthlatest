<?php

namespace App\Http\Requests\Customer\Address;

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
            'first_name'    => 'required|string|max:40',
            'last_name'     => 'required|string|max:40',
            'email'         => 'required|email|string',
            'mobile'        => 'required|numeric|digits_between:10,13',
            'address'       => 'required|max:250',
            'state'        => 'required|exists:states,id',
            'city'          => 'required|exists:cities,id',
            'landmark'      => 'nullable|max:50',
            'street'        => 'nullable|max:50',
            'pincode'       => 'required|numeric|digits:6'
        ];
    }
}
