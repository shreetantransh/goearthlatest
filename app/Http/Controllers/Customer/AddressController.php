<?php
/**
 * Created by PhpStorm.
 * User: bay
 * Date: 4/21/2018
 * Time: 10:24 AM
 */

namespace App\Http\Controllers\Customer;

use App\Http\Requests\Customer\Address\CreateRequest;
use App\Http\Requests\Customer\Address\UpdateRequest;
use App\Models\Address;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

class AddressController extends CustomerController
{
    public function index()
    {
        $addresses = $this->getCustomer()->addresses()->with('city', 'state')->get();

        return view('customer.address.index', compact('addresses'));
    }

    public function create(Request $request)
    {
        $state = old('state');

        if ($state) {
            $cities = City::active()->hasState($state)->orderBy('name')->pluck('name', 'id')->toArray();
        } else {
            $cities = ['' => 'Select City'];
        }

        $states = State::active()->orderBy('name')->pluck('name', 'id')->toArray();

        $address = new Address();

        return view('customer.address.edit', compact('cities', 'states', 'address'));
    }

    public function store(CreateRequest $request)
    {
        $values = $request->all();

        $values['is_default'] = isset($values['default']) ?: false;
        $values['city_id'] = $values['city'];
        $values['state_id'] = $values['state'];

        if (isset($values['default'])) {
            $this->getCustomer()->addresses()->update(['is_default' => false]);
        }

        $this->getCustomer()->addresses()->create($values);

        return redirect()->back()
            ->with($this->setMessage(
                'Your address has been successfully added.',
                self::MESSAGE_SUCCESS
            ));
    }

    public function edit($id)
    {
        $address = $this->getCustomer()->addresses()->findOrFail($id);

        $state = $address->state_id ? $address->state_id : old('state');

        if ($state) {
            $cities = City::active()->hasState($state)->orderBy('name')->pluck('name', 'id')->toArray();
        } else {
            $cities = ['' => 'Select City'];
        }


        $states = State::active()->orderBy('name')->pluck('name', 'id')->toArray();


        return view('customer.address.edit', compact('address', 'cities', 'states'));
    }

    public function update($id, UpdateRequest $request)
    {
        $values = $request->all();

        $address = $this->getCustomer()->addresses()->findOrFail($id);

        $values['is_default'] = isset($values['default']) ?: false;
        $values['city_id'] = $values['city'];
        $values['state_id'] = $values['state'];

        if (isset($values['default'])) {
            $this->getCustomer()->addresses()->update(['is_default' => false]);
        }

        $address->update($values);

        return redirect()->back()
            ->with($this->setMessage(
                'Your address has been successfully updated.',
                self::MESSAGE_SUCCESS
            ));
    }

    public function destroy($id)
    {
        $this->getCustomer()->addresses()->findOrFail($id)->delete();

        return redirect()->route('customer.address.index')
            ->with($this->setMessage(
                'Your address has been successfully deleted.',
                self::MESSAGE_SUCCESS
            ));
    }
}