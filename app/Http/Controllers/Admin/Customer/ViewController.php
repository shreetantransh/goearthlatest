<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function __invoke(Customer $customer)
    {
        return $this->index($customer);
    }

    public function index(Customer $customer)
    {
        return view('admin.customer.view', compact('customer'));
    }
}
