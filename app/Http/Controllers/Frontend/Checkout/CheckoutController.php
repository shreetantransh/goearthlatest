<?php

namespace App\Http\Controllers\Frontend\Checkout;

use App\Logic\MSG91;
use App\Logic\PayTm;
use App\Mail\SendMailable;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use function MongoDB\BSON\toJSON;
use PaytmWallet;
use App\Http\Controllers\Customer\CustomerController;
use App\Logic\Cart;
use App\Models\Address;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderLog;
use App\Models\OrderProduct;
use App\Models\ProductStock;
use App\Models\State;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Softon\Indipay\Facades\Indipay;

class CheckoutController extends CustomerController
{

    //load checkout page
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
    //save address from checkout
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

    //currently this function not used but we can used later to store guest data in customer table
    public function postSaveGuest(Request $request){

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'mobile' => 'required|numeric',
            'email' => 'required|email|unique:customers',
            'password'=>'required|min:8'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

    }
    //post checkout form
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
        $orderObj->sub_total=$this->cart->getSubTotal(false);
        $orderObj->total=$this->cart->grandTotal(false,true);
        $orderObj->discount=$this->cart->getDiscount();
        $orderObj->payment_mode= $request->input('payment_method');
        $orderObj->transaction_id = rand(000000000,999999999); //generate random transaction id
        $orderObj->save();

        //update order id with prefix 1000
        $orderObj->order_id = 1000 + $orderObj->id;
        $orderObj->save();

        //get last order id
        $orderObj = Order::where('customer_id','=',$this->getCustomer()->id)->orderBy('id','desc')->limit(1)->first();

        //set order id in session so we can use in thank you and confirm detail page
        //remove previous session and set new order id
        Session::remove('orderId');
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

        if($cartItems->count())
        {
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

                //update stock
                $updateStockObj = ProductStock::where('product_id','=',$item->product->id)->first();
                if($updateStockObj)
                {
                    if($updateStockObj->manage_stock == 1)
                    {
                        if($updateStockObj->quantity >0){
                            $updateStockObj->quantity -= 1; //update quantity decrement by 1
                        }
                        else{
                            $updateStockObj->stock_availability = 0;
                        }
                        $updateStockObj->save();
                    }
                }
            }

            //make cart empty
            $this->cart->getCart()->items()->delete();  // remove items from cart
            $this->cart->getCart()->delete();          //remove cart row

        }



        if($request->input('payment_method') === 'CCAvenue')
        {
            return redirect('checkout/get-ccavenue');
        }
        elseif($request->input('payment_method') === 'Paytm')
        {
            return redirect('checkout/get-paytm');
        }
        else
        {
            return redirect('checkout/thank-you');
        }

    }
    //function for thankyou page after checkout for COD
    public  function getThankYou()
    {
        $orderId = Session::get('orderId');
        if(is_null($orderId)){
            return redirect('/');
        }

        //get order details by order id
        $order = Order::where('id','=',$orderId)->with('customer')->first();

        //send message notification
        $this->sendMessageNotification($orderId);

        //send email notification
        $this->sendEmailNotification($orderId);

        return view('customer.checkout.thankyou',compact('order'));
    }

    //function for redirect to ccavenue after checkout
    public function getCCAvenue()
    {
        $orderId = Session::get('orderId');
        if(is_null($orderId)){
            return redirect('/');
        }

        //get order details by order id
        $orderObj = Order::where('id','=',$orderId)->with('customer')->first();

        /* All Required Parameters by your Gateway */

        $parameters = [

            'tid' => $orderObj->transaction_id,

            'order_id' => $orderObj->id,

            'amount' => $orderObj->total,

        ];

        $order = Indipay::prepare($parameters);
        return Indipay::process($order);
    }

    public function  postResponseCCAvenue(Request $request)
    {
        $orderId = Session::get('orderId');
        if(is_null($orderId)){
            return redirect('/');
        }

        //get order details by order id
        $order = Order::where('id','=',$orderId)->with('customer')->first();

        // For default Gateway
        $response = Indipay::response($request);

        $status = "Credit";   // for testing
        $transaction_id=123456;   // for testing
        //status = $response->payment_request->payments[0]->status;
        //$transaction_id =$response->payment_request->payments[0]->payment_id;
        //uncomment this line if you got response

        if($status === "Credit"){

            //update trasaction id on current order id
            $order->transaction_id = $transaction_id ; // use transaction id from response object instead hard code value
            $order->is_paid=1;
            $order->save();

            //send message notification
            $this->sendMessageNotification($orderId);

            //send email notification
            $this->sendEmailNotification($orderId);

            return view('customer.checkout.ccavenue.success_response', compact('order'));
        }
        else{
            $order->transaction_id = $transaction_id ;
            $order->is_paid=0;
            $order->save();
            return view('customer.checkout.ccavenue.failer_response', compact('order'));
        }
    }

    public function  getPayTm()
    {
        $orderId = Session::get('orderId');
        if(is_null($orderId)){
            return redirect('/');
        }

        //get order details by order id
        $order = Order::where('id','=',$orderId)->with('customer')->first();

        $paytmObj = new PayTm();
        $data_for_request = $paytmObj->handlePaytmRequest( $order->id, $order->total );

        if(env('PAYTM_ENVIRONMENT') === 'TEST'){
            $paytm_txn_url = 'https://securegw-stage.paytm.in/theia/processTransaction';
        }
        else{
            $paytm_txn_url = 'https://securegw.paytm.in/theia/processTransaction';
        }
         $paramList = $data_for_request['paramList'];
         $checkSum = $data_for_request['checkSum'];
        //return view( 'customer.checkout.paytm.paytm-merchant-form', compact( 'paytm_txn_url', 'paramList', 'checkSum' ) );

    }

    public function  postResponsePayTm(Request $request)
    {

        var_dump($request->all());
        dd('test');
//
//        $orderId = Session::get('orderId');
//        if(is_null($orderId)){
//            return redirect('/');
//        }
//
//        //get order details by order id
//        $order = Order::where('id','=',$orderId)->with('customer')->first();
//
//        if(1){
//            //update transaction id on current order id
//            $order->transaction_id = $transaction->getTransactionId();
//            $order->is_paid=1;
//            $order->save();
//
//            //send message notification
//            $this->sendMessageNotification($orderId);

              //send email notification
//            $this->sendEmailNotification($orderId);
//
//            return view('customer.checkout.paytm.success_response', compact('order'));
//        }
//        elseif(){
//            $order->transaction_id = $transaction->getTransactionId();
//            $order->is_paid=0;
//            $order->save();
//            return view('customer.checkout.paytm.failer_response', compact('order'));
//        }
    }

    // this function  is used when user click on cart icon in header bar to show cart on page instead popup
    //currently this function is not use you can delete this function and cart.blade file at your own risk
    public function  getCart(){
        $cartItems = $this->cart->getCart()->items()->with('product')->get();
        return view('customer.checkout.cart', compact('cartItems'));
    }

    //this function is used for update cart item from checkout page
    public  function updateCart(Request $request)
    {
        $cart = $this->cart->getCart();

          if (is_array($request->input('qty'))) {

              foreach ($request->input('qty') as $itemId => $qty) {

                  if ($cart->items()->where('id', $itemId)->count() > 0 && $qty > 0) {

                      $cart->items()->find($itemId)->update([
                          'qty' => $qty
                      ]);
                  }
              }
          }

          return redirect('checkout/get-checkout');
    }
    //this function is used for delete cart item from checkout page
    public function deleteCartItem($itemId)
    {
        $cart = $this->cart->getCart();

        if ($cartItem = $cart->items()->find($itemId)) {
            $this->cart->removeItem($cartItem);
        }

        return redirect('checkout/get-checkout');
    }

    public function sendMessageNotification($orderId)
    {
        if(is_null($orderId)){
           return redirect('/');
        }

        //get order details by order id
        $order = Order::where('id','=',$orderId)->with('customer')->first();

        $fname=$order->customer->first_name;

        if($order->payment_mode ==='Paytm' || $order->payment_mode === 'CCAvenue'){
            //Your message to send, Adding URL encoding.s
            $payment_status = ($order->is_paid ==1)? 'Paid': 'Unpaid';
            $message = urlencode("Hello $fname , we've received your order.Your Order Id is :$order->id Amount : $order->total Payment mode : $order->payment_mode  Transaction Id : $order->transaction_id  Status : $payment_status. Thank you");
        }
        else{
            //Your message to send, Adding URL encoding.s
            $message = urlencode("Hello $fname , we've received your order.Your Order Id is :$order->id Amount : $order->total Payment mode : $order->payment_mode . Thank you");
        }

        $MSG91 = new MSG91();
        $msg91Response = $MSG91->sendSMS($order->customer->mobile,$message);
    }

    public function  sendEmailNotification($orderId){

        if(is_null($orderId)){
            return redirect('/');
        }

        //get order details by order id
        $order = Order::where('id','=',$orderId)->with('customer','address','address.city','address.state')->first();

        //send mail
        Mail::send('customer.checkout.email',compact('order'),function($message) use ($order){
            $message->to($order->customer->email,'Go earth organic')->subject('Order Confirmation');
        });
    }

    public function applyVoucher(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(array('error'=>1,'msg'=>'Please enter code'));
        }

        $voucherObj = Voucher::where([
            ['code','=',$request->input('code')],
            ['is_active','=',1]
        ])->first();

        //fetch cart amount
        $cartAmount = $this->cart->getSubTotal();

        //check voucher valid or not
        if($voucherObj){
                //no need to check is used because amount already fetch from cart so you can remove this
                if($voucherObj->is_used === 1){
                    return response()->json(array('error'=>1,'msg'=>'Voucher has been used already'));
                }
                else{
                    //check cart amount with minimum cart amount
                    if($cartAmount < $voucherObj->min_cart_amount){
                        return response()->json(array('error'=>1,'msg'=>"Your minimum cart amount is less than $voucherObj->min_cart_amount "));
                    }
                    else if(!Carbon::now()->between(Carbon::parse(Carbon::createFromFormat('d/m/Y',$voucherObj->valid_from)), Carbon::parse(Carbon::createFromFormat('d/m/Y',$voucherObj->valid_to))))
                    {
                        return response()->json(array('error'=>1,'msg'=>"Voucher validity has been expired"));
                    }  // add here product SKU and categories condition in else if
                    else{
                        if($voucherObj->type ==1){
                            $discount=$voucherObj->discount;

                            //add voucher to cart
                            $this->cart->getCart()->update(['voucher' => $voucherObj->code, 'discount' => $discount]);

                            //get total amount after discount
                            $total_amount =$this->cart->grandTotal(true,true);

                            //expire voucher after use
                            $voucherObj->is_used=1;
                            $voucherObj->save();

                            return response()->json(array('error'=>0,'msg'=>"Congrats! You got Rs. $discount discount",'discount'=>$discount,'total_amount'=>$total_amount));
                        }
                        elseif($voucherObj->type == 2){
                            $discount = ($cartAmount * $voucherObj->discount) * 100;

                            if($discount>$voucherObj->max_discount){
                                return response()->json(array('error'=>1,'msg'=>"Discount must be less than to maximum discount $voucherObj->max_discount "));
                            }

                            //add voucher to cart
                            $this->cart->getCart()->update(['voucher' => $voucherObj->code, 'discount' => $discount]);

                            //get total amount after discount
                            $total_amount =$this->cart->grandTotal(true,true);

                            //expire voucher after use
                            $voucherObj->is_used=1;
                            $voucherObj->save();

                            return response()->json(array('error'=>0,'msg'=>"Congrats! You got Rs. $discount discount",'discount'=>$discount,'total_amount'=>$total_amount));
                        }
                    }
                }

        }
        else{
            return response()->json(array('error'=>1,'msg'=>'Invalid code'));
        }
    }
}
