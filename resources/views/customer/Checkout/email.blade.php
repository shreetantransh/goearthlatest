<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="header-content">
                <h4>Hi {{$order->customer->first_name}},</h4>
                <p>Thank you for your order </p>
                <p>Your Order has been confirmed</p>
            </div>

            <div class="order-details">
                <h4>Order Details :</h4>
                <p>Order Id : {{$order->id}} </p>
                <p>Total Amount : {{$order->total}} </p>
                <p>Payment Mode :{{$order->payment_mode}} </p>
                @if($order->payment_mode === 'Paytm' || $order->payment_mode === 'CCAvenue')
                    <p>Transaction Id :{{$order->transaction_id}} </p>
                    <p>Status :{{ ($order->is_paid ==1) ? 'Paid':'Unpaid' }} </p>
                @endif
            </div>

            <div class="shipping-address-details">
                <h4>Shipping Address : </h4>
                <p>Name : {{$order->address->first_name}}  {{ $order->address->last_name}} </p>
                <p>Email : {{$order->address->email}}</p>
                <p>Mobile : {{$order->address->mobile}} </p>
                <p>Gender : {{$order->address->gender}} </p>
                <p>Address : {{$order->address->address}}</p>
                <p>Street : {{$order->address->street}}</p>
                <p>Landmark : {{$order->address->landmark}}</p>
                <p>City :  {{$order->address->city->name}}</p>
                <p>Pincode : {{$order->address->pincode}}</p>
                <p>State : {{$order->address->state->name}}</p>
            </div>
            <div class="footer-content">
                <h4> We look forward to seeing you again soon.</h4>
                <p> Team <br> GoEarthOrganic </p>
            </div>
        </div>
    </div>
</div>