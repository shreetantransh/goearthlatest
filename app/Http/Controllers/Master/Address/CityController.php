<?php

namespace App\Http\Controllers\Master\Address;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    public function getCities(Request $request)
    {
        $cities = City::active()->hasState($request->state)->pluck('name', 'id');

        if($cities->count())
        {
            $options = '<option value="">Select City</option>';

            foreach ($cities as $id => $name) {
                $options .= '<option value="' . $id . '">' . $name . '</option>';
            }


            return response()->json([
                'options' => $options
            ]);
        }
    }
}
