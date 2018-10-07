<?php
/**
 * Created by PhpStorm.
 * User: bay
 * Date: 4/9/2018
 * Time: 7:14 PM
 */

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Customer\CustomerController;
use App\Models\Customer;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Validator;
use Auth;

class RegisterController extends CustomerController
{
    use RegistersUsers;

    protected $redirectTo = 'customer/dashboard';

    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest:customer');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'mobile' => 'required|numeric|digits_between:10,13|unique:customers',
            'password' => 'required|min:5'
        ]);
    }

    protected function create(array $data)
    {
        return Customer::create($data);
    }

    protected function guard()
    {
        return Auth::guard('customer');
    }

    protected function registered(Request $request, Customer $customer)
    {
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'redirectUrl' => redirect()->intended(route('customer.dashboard'))->getTargetUrl()
            ]);
        }
    }

    public function emailAvailability()
    {
        return Customer::where('email', \request('email'))->count() > 0 ? 'false' : 'true';
    }

    public function mobileAvailability()
    {
        return Customer::where('mobile', \request('mobile'))->count() > 0 ? 'false' : 'true';
    }
}