<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://use.fontawesome.com/ad5b5eb053.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="invoice-title">
                <h2 CLASS="pull-left">Invoice</h2>
                <h2 CLASS="pull-right">{{ env('APP_NAME') }}</h2>
                <div class="clearfix"></div>
                <hr>
            </div>

            <div class="row">
                <div class="col-xs-6">
                    <address>
                        <strong>Order #</strong> {{ $order->order_id }}<br>
                        <strong>Order Date</strong> {{ $order->created_at->format('F j Y') }}<br>
                        <strong>Payment Mode</strong> {{ $order->payment_mode == 'cod' ? 'Cash on delivery' : $order->payment_mode }}<br>
                    </address>
                </div>

            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Order placed on {{ $order->created_at->format('F j Y') }}</strong>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <td><strong>Product</strong></td>
                                <td class="text-center"><strong>Price</strong></td>
                                <td class="text-center"><strong>Quantity</strong></td>
                                <td class="text-center"><strong>Total</strong></td>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- foreach ($order->lineItems as $line) or some such thing here -->
                            @if($products->count())
                                @foreach($products as $product)
                                    <tr>
                                        <td class="col-md-3">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h4 class="media-heading"> {{ $product->getName() }}</h4>
                                                    <h5 class="media-heading"> SKU: {{ $product->getSku() }}</h5>
                                                </div>
                                            </div>


                                        </td>
                                        <td class="text-center"><i class="fa fa-inr" aria-hidden="true"></i> {{ $product->pivot->sub_total }}</td>
                                        <td>
                                            <div class="col-md-13">

                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            @endif


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-xs-6">
                    <address>
                        <strong>Billed To:</strong><br>
                        {{ $customer->getFullName() }}<br>
                        {{ $customer->mobile }}<br>
                        {{ $customer->email }}<br>
                        {{ $customer->gender }}
                    </address>
                </div>
                <div class="col-xs-6 text-right">
                    <address>
                        <strong>Shipped To:</strong><br>
                        {{ $address->getFullName() }}<br>
                        {{ $address->email }}<br>
                        Ph: {{ $address->mobile }}<br>
                        {{ $address->street }}, {{ $address->address }}<br>
                        {{ optional($address->city)->getName() }}, {{ optional($address->state)->getName() }}<br>
                        {{ $address->pincode }}<br>
                        Gender: {{ $address->gender }}<br>
                        Landmark: {{ $address->landmark }}<br>
                    </address>
                </div>
            </div>

        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">

            <div class="col-md-4 pull-right">
                <h3 class="text-right">Order Summary</h3>

                <div class="pull-left"><h4>Subtotal</h4></div>
                <div class="pull-right"><h4 class="text-right"><i class="fa fa-inr" aria-hidden="true"></i> {{ number_format($order->sub_total) }}</h4></div>
                <div class="clearfix"></div>
                <div class="pull-left"><h4>Discount</h4></div>
                <div class="pull-right"><h4 class="text-right"><i class="fa fa-inr" aria-hidden="true"></i> {{ number_format($order->discount) }}</h4></div>
                <div class="clearfix"></div>
                <div class="pull-left"><h4>Order Total</h4></div>
                <div class="pull-right"><h4 class="text-right"><i class="fa fa-inr" aria-hidden="true"></i> {{ number_format($order->total) }}</h4></div>
                <div class="clearfix"></div>
            </div>


        </div>
    </div>
</div>