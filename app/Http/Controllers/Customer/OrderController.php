<?php
/**
 * Created by PhpStorm.
 * User: bay
 * Date: 4/21/2018
 * Time: 10:26 AM
 */

namespace App\Http\Controllers\Customer;


class OrderController extends CustomerController
{
    public function index()
    {
        return view('customer.order.index');
    }

    public function detail()
    {
        return view('customer.order.detail');
    }
}