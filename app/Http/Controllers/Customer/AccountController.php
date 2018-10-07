<?php
/**
 * Created by PhpStorm.
 * User: bay
 * Date: 4/21/2018
 * Time: 10:19 AM
 */

namespace App\Http\Controllers\Customer;


use App\Rules\Mobile;
use Illuminate\Http\Request;

class AccountController extends CustomerController
{
    public function index()
    {
        $customer = $this->getCustomer();
        return view('customer.account.index', compact('customer'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile' => [ 'required', 'string', new Mobile() ],
            'gender' => 'required|in:' . $this->getCustomer()->getGenders()->implode(','),
            'dob' => 'required|date_format:d/m/Y',

            'current_password' => 'required_if:change_password,1',
            'password' => 'nullable|required_if:change_password,1|min:5|different:current_password|confirmed',
        ], [
            'current_password.required_if' => 'The current password field is required.',
            'password.required_if' => 'The new password field is required.'
        ], [
            'mobile' => 'contact number'
        ]);

        $values = $request->except('password', 'email');

        if ($request->input('password')) {

            if ( ! \Hash::check($request->input('current_password'), $this->getCustomer()->password) ) {
                return redirect()->back()->withErrors([
                    'current_password' => ['The provided password is not valid.']
                ])->withInput();
            }

            $values['password'] = $request->input('password');
        }

        $this->getCustomer()->update($values);

        return redirect()->back()
            ->with($this->setMessage(
                'Your account has been successfully updated.',
                self::MESSAGE_SUCCESS
            ));
    }
}