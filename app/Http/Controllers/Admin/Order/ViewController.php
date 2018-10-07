<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends AdminController
{
    public function __invoke(Order $order)
    {
        return $this->index($order);
    }

    public function index($order)
    {
        $products = $order->products()->setRelationship()->addAttributeToSelect(['name', 'price', 'special_price', 'status'])->withPivot(['price', 'quantity', 'sub_total'])->get();
        $address = $order->address()->first();

        return view('admin.order.view', compact('order', 'address', 'products'));
    }
}
