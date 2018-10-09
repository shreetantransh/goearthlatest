<?php

namespace App\Http\Controllers\Frontend\Checkout;

use App\Http\Controllers\Customer\CustomerController;
use App\Models\Address;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderProduct;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends CustomerController
{
    public  function  getCheckout()
    {

        //get items form cart
        $cartItems = $this->cart->getCart()
            ->items()
            ->with('product')
            ->get();

       //if cart blank then redirect to cart page instead checkout
        if(!$cartItems->count()){
            return view('customer.cart.index',compact('cartItems'));
        }

        //get all states
        $states = State::all()->where('status','=',1);

        //if logged in then get address of that customer
        $addresses = $this->getCustomer()->addresses()->with('city', 'state')->get();

       //redirect to checkout page with cartitems
        return view('customer.checkout.index',compact('cartItems','states','addresses'));
    }

    public function postAddress(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'state_id' => 'required|integer',
            'city_id' => 'required|integer',
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required',
            'street' => 'required|max:255',
            'landmark' => 'required|max:255',
            'pincode' => 'required|integer',
            'address' => 'required|string|min:2',

        ]);

        if ($validator->fails()) {
            return response()->json(['status'=> 0, 'error'=> $validator->errors()]);

        }

        //$orderObj = Order::create();

        return response()->json(['status'=>1,'message'=>'Success']);

    }

    public function  postCheckout(Request $request){

        $validator = Validator::make($request->all(), [
            'state_id' => 'required|integer',
            'city_id' => 'required|integer',
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required',
            'street' => 'required|max:255',
            'landmark' => 'required|max:255',
            'pincode' => 'required|integer',
            'address' => 'required|string|min:2',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=>0,'error'=> $validator->errors()]);

        }

        //save order details
        $orderObj= new Order();
        $orderObj->order_id=1000;   //
        $orderObj->customer_id=$this->getCustomer();
        //$orderObj->sub_total=$_cart->grandTotal(true);
        //$orderObj->total=$_cart->grandTotal(true);
        $orderObj->payment_method= $request->input('payment_method');
        $orderObj->save();


        $deliver_address_id= $request->input('deliver_address_id');
        $addressObj = Address::find($deliver_address_id)->where('customer_id','=',$this->customer)->fisrt();


        //save order address details
        $orderAddressObj = new OrderAddress();
        $orderAddressObj->order_id= $orderObj->id;
        $orderAddressObj->city_id= $request->input('city_id');
        $orderAddressObj->state_id= $request->input('state_id');
        $orderAddressObj->fisrt_name= $request->input('first_name');
        $orderAddressObj->last_name= $request->input('last_name');
        $orderAddressObj->mobile= $request->input('mobile');
        $orderAddressObj->address= $request->input('address');
        $orderAddressObj->street= $request->input('street');
        $orderAddressObj->landmark= $request->input('landmark');
        $orderAddressObj->pincode= $request->input('pincode');
        $orderAddressObj->is_default= $request->input('is_default');
        $orderAddressObj->save();

        //no need to store gender and email in order address table

       //get items form cart and store in order products table
        $cartItems = $this->cart->getCart()
            ->items()
            ->with('product')
            ->get();

        foreach($cartItems as $item){
            //save product details
            $orderProductObj= new OrderProduct();
            $orderProductObj->order_id=$orderObj->id;
            $orderProductObj->customer_id = Auth::user()->id;
            $orderProductObj->product_id = $item->product->id;
            $orderProductObj->price = $item->product->getFormattedFinalPrice();
            $orderProductObj->quantity=$item->qty;
            $orderProductObj->sub_total=$item->getProductFormattedTotal();
            $orderProductObj->save();
        }


        //make cart empty
        $cartItemsObj = CartItem::find();


        if($request->input('payment_method') == 'COD'){

        }

    }


}
