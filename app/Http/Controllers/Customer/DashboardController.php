<?php
/**
 * Created by PhpStorm.
 * User: bay
 * Date: 4/19/2018
 * Time: 12:03 PM
 */

namespace App\Http\Controllers\Customer;


class DashboardController extends CustomerController
{
    public function __invoke()
    {
        return view('customer.dashboard');
    }
}