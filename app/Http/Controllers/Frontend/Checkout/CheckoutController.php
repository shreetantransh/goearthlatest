<?php

namespace App\Http\Controllers\Frontend\Checkout;

use App\Http\Controllers\Customer\CustomerController;
use App\Logic\Cart;
use App\Models\Address;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderLog;
use App\Models\OrderProduct;
use App\Models\State;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class CheckoutController extends CustomerController
{
    public  function  getCheckout()
    {
        //get items form cart
        $cartItems = $this->cart->getCart()->items()->with('product')->get();

       //if cart blank then redirect to cart page instead checkout
        if(!$cartItems->count()){
            return view('customer.cart.index',compact('cartItems'));
        }

        //get all states
        $states =State::all()->where('status','=',1);

        $addresses = array();
        if($this->getCustomer()){
            //if logged in then get address of that customer
            $addresses = $this->getCustomer()->addresses()->with('city', 'state')->get();
        }

        //redirect to checkout page with cartitems
        return view('customer.checkout.index',compact('cartItems','states','addresses'));
    }

    public function postAddress(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'state' => 'required|integer',
            'city' => 'required|integer',
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required',
            'gender' => 'required',
            'email' => 'required|email',
            'street' => 'required|string',
            'landmark' => 'required|string',
            'pincode' => 'required|integer',
            'address' => 'required|string|min:2',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $addressObj = new Address();
        $addressObj->first_name=$request->input('first_name');
        $addressObj->last_name=$request->input('last_name');
        $addressObj->email=$request->input('email');
        $addressObj->gender=$request->input('gender');
        $addressObj->mobile=$request->input('mobile');
        $addressObj->customer_id = $this->getCustomer()->id;
        $addressObj->address=$request->input('address');
        $addressObj->street=$request->input('street');
        $addressObj->landmark=$request->input('landmark');
        $addressObj->state_id=$request->input('state');
        $addressObj->city_id=$request->input('city');
        $addressObj->pincode=$request->input('pincode');
        $addressObj->is_default=($request->input('is_default')) == 'on' ? 1 : 0;
        $addressObj->save();


        return redirect('checkout/get-checkout');
    }

    public function  postCheckout(Request $request)
    {
        //get items form cart and store in order products table
        $cartItems = $this->cart->getCart()->items()->with('product')->get();
        if(!$cartItems->count()){
            //if cart already blank then redirect to cart page
           return view('customer.cart.index',compact('cartItems'));
        }

        //save order details
        $orderObj= new Order();
        $orderObj->customer_id=$this->getCustomer()->id;
        $orderObj->sub_total=$this->cart->grandTotal(false);
        $orderObj->total=$this->cart->grandTotal(false);
        $orderObj->payment_mode= $request->input('payment_method');
        $orderObj->save();

        //update order id with prefix 1000
        $orderObj->order_id=1000 + $orderObj->id;
        $orderObj->save();

        //get last order id
        $orderObj = Order::where('customer_id','=',$this->getCustomer()->id)->orderBy('id','desc')->limit(1)->first();

        //set order id in session so we can use in thank you and confirm detail page
        Session::put('orderId',$orderObj->id);

        //save order log by default pending status
        $orderLogObj = new OrderLog();
        $orderLogObj->order_id=$orderObj->id;
        $orderLogObj->status='Pending';
        $orderLogObj->comments='Order created, payment pending';
        $orderLogObj->save();


        $deliver_address_id= $request->input('delivery_address_id');
        $addressObj = Address::findorfail($deliver_address_id)->where('customer_id','=',$this->getCustomer()->id)->first();

        if($addressObj){
            //save order address details
            $orderAddressObj = new OrderAddress();
            $orderAddressObj->order_id= $orderObj->id;  // last order id
            $orderAddressObj->city_id= $addressObj->city_id;
            $orderAddressObj->state_id= $addressObj->state_id;
            $orderAddressObj->first_name= $addressObj->first_name;
            $orderAddressObj->last_name= $addressObj->last_name;
            $orderAddressObj->email= $addressObj->email;
            $orderAddressObj->gender= $addressObj->gender;
            $orderAddressObj->mobile= $addressObj->mobile;
            $orderAddressObj->address= $addressObj->address;
            $orderAddressObj->street= $addressObj->street;
            $orderAddressObj->landmark= $addressObj->landmark;
            $orderAddressObj->pincode= $addressObj->pincode;
            $orderAddressObj->is_default= $addressObj->is_default;
            $orderAddressObj->save();
        }

        if($cartItems->count()){
            foreach($cartItems as $item){
                //save product details
                $orderProductObj= new OrderProduct();
                $orderProductObj->order_id=$orderObj->id;  //last order id
                $orderProductObj->customer_id = $this->getCustomer()->id;
                $orderProductObj->product_id = $item->product->id;
                $orderProductObj->price = $item->product->getFormattedFinalPrice();
                $orderProductObj->quantity=$item->qty;
                $orderProductObj->sub_total=$item->getProductFormattedTotal();
                $orderProductObj->save();
            }

            //make cart empty
            $this->cart->getCart()->items()->delete();  // remove items from cart
            $this->cart->getCart()->delete();          //remove cart row by session id

        }

        if($request->input('payment_method') === 'COD'){
            return redirect('checkout/thank-you');
        }
        else
        {
            return redirect('checkout/confirm-details');
        }
    }


    //function for thankyou page after checkout by COD
    public  function getThankYou()
    {
        $orderId = Session::get('orderId');
        if(is_null($orderId)){
            return redirect('home');
        }

        //get order details by order id
        $order = Order::where('id','=',$orderId)->with('customer')->first();
        return view('customer.checkout.thankyou',compact('order'));
    }

    //fucntion for confirm details after checkout By CCavenue
    public function getConfirmDetails()
    {
        $orderId = Session::get('orderId');
        if(is_null($orderId)){
            return redirect('home');
        }
        //get order details by order id
        $order = Order::where('id','=',$orderId)->with('customer')->first();
        return view('customer.checkout.confirm_details',compact('order'));
    }


    // this fucntion  is used when user click on cart icon in header bar
    public function  getCart(){
        $cartItems = $this->cart->getCart()->items()->with('product')->get();
        return view('customer.checkout.cart', compact('cartItems'));
    }
}
