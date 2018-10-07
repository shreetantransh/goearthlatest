@extends('template.1column')
@section('content')
    <!-- Main Content -->
    <div id="checkout-main-content" class="site-content">
    <div class="container">
        <div class="page-checkout">
        <div class="row">
                <div class="checkout-left col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <div>
                        @if(Auth::check())
                            <p>Logged in as <span>{{ Auth::user()->email }}</span> </p>

                        @else
                            <p> Returning customer ? <a href="javascript:void(0)"  data-fancybox data-type="ajax" data-src="{{ route('customer.auth.account') }}"  title="Log in to your customer account">Click here to login</a> </p>
                        @endif

                    </div>

                    {!! Form::open(['route' => 'postCheckout']) !!}

                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                        Shipping Address
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="accordion-body collapse" style="height: 0px;">
                                <div class="panel-body " id="checkout-shipping">
                                    <div class="alert alert-danger" style="display:none"></div>
                                    @if($addresses->count())
                                        <div id="confirm-address" style="display: block;" class="">
                                            <div class="slider clearfix">
                                                <ul class="address-slider non-slider ">
                                                    @foreach($addresses as $key => $address)
                                                        <li style="margin-right: 0px;" class="col-md-4">
                                                        <div class="slide-box slide" data-index="0" data-address-id="{{$address->id}}">
                                                            <div class="main-content">
                                                                <div class="complete-aaddress">
                                                                    @if($address->is_default ==1)
                                                                        <div class="address-type-wrapper row">
                                                                            <div class="address-type ellipsis address-type-text">Default </div>
                                                                        </div>
                                                                    @endif
                                                                    <div class="address-wrapper">
                                                                        <div>
                                                                            <h3 class="ellipsis address-name">{{$address->first_name}} {{$address->last_name}}</h3>
                                                                        </div>
                                                                        <div class="user-address">
                                                                            <p class="custom-ellipsis address-address">{{$address->address}}</p>
                                                                            <p class="ellipsis address-city-pin">{{ optional($address->city)->getName()  }} - {{$address->pincode}}</p>
                                                                            <p class="ellipsis address-state">{{optional($address->state)->getName()}}</p>
                                                                        </div>
                                                                        <p class="address-phone">Phone: <span class="">{{$address->mobile}}</span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="btn-continue address-wrapper">
                                                                    <div data-index="0" data-address-id="{{$address->id}}" class="deliver_here btn btn-primary"> <span>DELIVER HERE</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <label>State</label>
                                                <select name="state" id="state" class="form-control">
                                                    <option value="0">Select a state</option>
                                                    @foreach($states as $state)
                                                        <option value="{{$state->id}}">{{$state->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label>City</label>
                                                <select name="city" id="city" class="form-control">
                                                    <option value="0">Select a city</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <label>First Name</label>
                                                <input type="text" id="fname" name="first_name" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Last Name</label>
                                                <input type="text" id="lname" name="last_name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <label>Mobile no. </label>
                                                <input type="phone" id="mobile" name="mobile" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Street</label>
                                                <input type="text" id="street" name="street" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <label>Landmark</label>
                                                <input type="text" id="landmark" name="landmark" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Pincode</label>
                                                <input type="number" id="pincode" name="pincode" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>Address </label>
                                                <textarea class="form-control" rows="5" id="address" name="address"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <span class="remember-box checkbox">
                                                    <label>
                                                        <input type="checkbox" checked="checked" value="1" id="is_default" name="is_default">Make this my default address
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="submit" value="Save" class="btn pull-right btn-primary">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                        Review Order
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="accordion-body collapse" style="height: 0px;">
                                <div class="panel-body">
                                    @if($cartItems->count())
                                        <table class="table listproducts">
                                            <thead>
                                            <tr>
                                                <th class="width-80 text-center">Items</th>
                                                <th class="width-100 text-center">Unit price</th>
                                                <th class="width-100 text-center">Quantity(Kg.)</th>
                                                <th class="width-100 text-center">Sub Total</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            @foreach ($cartItems as $key => $cartItem)
                                                <tr class="product-row">
                                                    <td class="text-left">
                                                        <a href="javascript:void(0)" class="product-item-photo">
                                                            <img src="{{ $cartItem->product->getBaseImage(\App\Models\ProductImage::VERY_SMALL) }}" class="img-responsive" alt="img" title="img" height="60" width="60"/>
                                                        </a>
                                                        <div class="product-item-details">
                                                            <strong class="product-item-name"><a href="javascript:void(0)">{{ $cartItem->product->getName() }}</a> </strong>
                                                        </div>

                                                        <div class="name"></div>
                                                    </td>
                                                    <td class="text-center">{!! $cartItem->product->getFormattedFinalPrice() !!}</td>
                                                    <td class="text-center">
                                                        <p class="qtypara">
                                                            {{ $cartItem->qty }}
                                                        </p>
                                                    </td>
                                                    <td class="text-center">{!! $cartItem->getProductFormattedTotal() !!}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="3">Grand Total</td>
                                                <td colspan="1" class="text-right">{!! $_cart->grandTotal(true) !!}</td>
                                            </tr>
                                            </tbody>
                                        </table>

                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="button" id="proceed_to_payment" value="Proceed to Payment" class="btn pull-right btn-primary">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                        Make Payment
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="accordion-body collapse" style="height: 0px;">
                                <div class="panel-body">
                                    <h4 class="heading-primary">Payment</h4>
                                    <div class="radio">
                                        <label><input type="radio" name="payment_method" checked>Pay by COD</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="payment_method">Pay by CCAvenue</label>
                                    </div>

                                    <div class="pull-right">
                                        <input type="submit" value="Place Order" name="proceed" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {!! Form::close() !!}


                </div>


                <div class="checkout-right col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <h4 class="title">Order Summary</h4>
                    <table class="table cart-total">
                        <tbody>
                        <tr class="total">
                            <th>
                                <strong>Grand Total</strong>
                            </th>
                            <td>
                                <strong><span class="amount">{!! $_cart->grandTotal(true) !!}</span></strong>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

        </div>
        </div>
    </div>


    </div>
@endsection