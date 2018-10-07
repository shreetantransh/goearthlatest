<?php

namespace App\Http\Controllers\Admin\Order;

use App\Models\Order;
use App\Notifications\Admin\Order\Canceled;
use App\Notifications\Admin\Order\Completed;
use App\Notifications\Admin\Order\InProcessing;
use App\Notifications\Admin\Order\Shipped;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    public function __invoke(Order $order)
    {
        $products = $order->products()->setRelationship()->addAttributeToSelect(['name', 'price', 'special_price', 'status'])->withPivot([ 'price', 'quantity', 'sub_total'])->get();
        $address = $order->address()->first();
        $customer = $order->customer()->first();

        return view('admin.order.invoice', compact('order', 'address', 'products', 'customer'));
    }

    public function updateStatus(Request $request)
    {
        $order = Order::find($request->order);

        if ($order) {
            $customer = $order->customer()->first();

            $order->status = $request->status;
            $order->save();

            $this->sendStatusMail($order, $customer, $request);

            return redirect()->back()->with($this->setMessage('Status successfully updated.', self::MESSAGE_SUCCESS));
        }
    }

    protected function sendStatusMail($order, $customer, $request)
    {
        $products = $order->orderProducts()->get();

        if($request->status == 1)
            $customer->notify(New InProcessing($order, $customer, $products));

        if($request->status == 2)
            $customer->notify(New Shipped($order, $customer, $products));

        if($request->status == 3)
            $customer->notify(New Canceled($order, $customer, $products));

        if($request->status == 4)
            $customer->notify(New Completed($order, $customer, $products));
    }
}
