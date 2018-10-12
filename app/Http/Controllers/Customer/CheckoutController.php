<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckoutController extends CustomerController
{
    //this controller is not used you can delete this.
    public  function  getCheckout()
    {
        return view('customer.checkout.index');
    }
}
