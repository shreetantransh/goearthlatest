<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckoutController extends CustomerController
{
    public  function  getCheckout()
    {
        return view('customer.checkout.index');
    }
}
