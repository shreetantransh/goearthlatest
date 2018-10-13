@extends('template.1column')
@section('content')
    <!-- Main Content -->
    <div id="checkout-main-content" class="site-content">
    <div class="container">
        <div class="page-checkout">
        <div class="row">
                <div class="checkout-left col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                        1. Login
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="accordion-body collapse {{(Auth::check())?'':'show'}}">
                                <div class="panel-body " id="checkout-shipping">
                                    @if(Auth::check())
                                        <p>Logged in as <span>{{ Auth::user()->email }}</span> </p>
                                        <div class="row form-group">
                                            <div class="col-md-12">
                                                <input type="button" value="Continue Checkout" id="continue_checkout" class="btn pull-right btn-continue-checkout btn-primary">
                                            </div>
                                        </div>
                                    @else
                                        <p> Returning customer ? <a href="javascript:void(0)"  data-fancybox data-type="ajax" data-src="{{ route('customer.auth.account') }}"  title="Log in to your customer account">Click here to login</a> </p>
                                        {{--<p> Or Create an account</p>--}}
                                        {{--{!! Form::open(['route'=>'checkout.save_guest_details']) !!}--}}
                                            {{--<div class="row">--}}
                                                {{--<div class="col-md-6">--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<label class="control-label" for="first name">First Name</label>--}}
                                                        {{--{!! Form::text('first_name', null, ['class' => ('form-control' . ($errors->has('first_name') ? ' is-invalid' : '')), 'id' => 'first_name']) !!}--}}
                                                        {{--{!! $errors->first('first_name', '<p class="invalid-feedback">:message</p>') !!}--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<div class="col-md-6">--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<label class="control-label" for="last name">Last Name</label>--}}
                                                        {{--{!! Form::text('last_name', null, ['class' => ('form-control' . ($errors->has('last_name') ? ' is-invalid' : '')), 'id' => 'last_name']) !!}--}}
                                                        {{--{!! $errors->first('last_name', '<p class="invalid-feedback">:message</p>') !!}--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="row">--}}
                                                {{--<div class="col-md-6">--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<label class="control-label" for="email">Email Address</label>--}}
                                                        {{--{!! Form::email('email', null, ['class' => ('form-control' . ($errors->has('email') ? ' is-invalid' : '')), 'id' => 'email']) !!}--}}
                                                        {{--{!! $errors->first('email', '<p class="invalid-feedback">:message</p>') !!}--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<div class="col-md-6">--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<label class="control-label" for="mobile">Mobile</label>--}}
                                                        {{--{!! Form::text('mobile', null, ['class' => ('form-control' . ($errors->has('mobile') ? ' is-invalid' : '')), 'id' => 'mobile']) !!}--}}
                                                        {{--{!! $errors->first('mobile', '<p class="invalid-feedback">:message</p>') !!}--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="row">--}}
                                                {{--<div class="col-md-6">--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<label class="control-label" for="mobile">Password</label>--}}
                                                        {{--{!! Form::text('password', null, ['class' => ('form-control' . ($errors->has('password') ? ' is-invalid' : '')), 'id' => 'password']) !!}--}}
                                                        {{--{!! $errors->first('password', '<p class="invalid-feedback">:message</p>') !!}--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="row">--}}
                                                {{--<div class="form-group">--}}
                                                    {{--<div class="col-md-12">--}}
                                                        {{--<input type="submit" value="Save" id="save_as_guest" class="btn pull-right btn-continue-checkout btn-primary">--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--{!! Form::close() !!}--}}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                        2. Shipping Address
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="accordion-body collapse {{(Auth::check())?'show':''}}" >
                                <div class="panel-body " id="checkout-shipping">
                                    <div class="alert alert-danger" style="display:none"></div>
                                    @if(count($addresses))
                                        <div id="confirm-address" style="display: block;" class="">
                                            <div class="slider clearfix">
                                                <ul class="address-slider non-slider ">
                                                    @foreach($addresses as $key => $address)
                                                        <li style="margin-right: 0px;" class="col-md-3">
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
                                                                        <p class="address-phone"><strong> Phone: </strong> <span class="">{{$address->mobile}}</span>
                                                                        </p>
                                                                        <p class="address-landmark"><strong>Landmark: </strong>  <span>{{$address->landmark}}</span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="btn-continue address-wrapper">
                                                                    <div data-index="0" data-address-id="{{$address->id}}" class="deliver_here btn btn-primary"> <span>DELIVER HERE</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if($address->is_default)
                                                                @php
                                                                    $address_id = $address->id;
                                                                @endphp
                                                        @endif
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @else
                                        @php
                                            $address_id=null;
                                        @endphp
                                        {!! Form::open(['route' => 'checkout.saveAddress','id'=>'checkOutAddressForm']) !!}
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label>State</label>
                                                    <select name="state" id="state" class="form-control <?php echo ($errors->has('state') ? ' is-invalid' : '')?>">
                                                        <option value="">Select a state</option>
                                                        @foreach($states as $state)
                                                            <option value="{{$state->id}}">{{$state->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->first('state'))
                                                        <p class="error">{{$errors->first('state')}}</p>
                                                    @endif

                                                </div>
                                                <div class="col-md-6">
                                                    <label>City</label>
                                                    <select name="city" id="city" class="form-control <?php echo ($errors->has('city') ? ' is-invalid' : '')?>">
                                                        <option value="">Select a city</option>
                                                    </select>
                                                    @if($errors->first('city'))
                                                        <p class="error">{{$errors->first('city')}}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label>First Name</label>
                                                    <input type="text" id="fname" name="first_name" class="form-control <?php echo ($errors->has('first_name') ? ' is-invalid' : '')?>">
                                                    @if($errors->first('first_name'))
                                                        <p class="error">{{$errors->first('first_name')}}</p>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Last Name</label>
                                                    <input type="text" id="lname" name="last_name" class="form-control <?php echo ($errors->has('last_name') ? ' is-invalid' : '')?>">
                                                    @if($errors->first('last_name'))
                                                        <p class="error">{{$errors->first('last_name')}}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label>Mobile no. </label>
                                                    <input type="phone" id="mobile" name="mobile" class="form-control <?php echo ($errors->has('mobile') ? ' is-invalid' : '')?>">
                                                    @if($errors->first('mobile'))
                                                        <p class="error">{{$errors->first('mobile')}}</p>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Email</label>
                                                    <input type="email" id="email" name="email" class="form-control <?php echo ($errors->has('email') ? ' is-invalid' : '')?>">
                                                    @if($errors->first('email'))
                                                        <p class="error">{{$errors->first('email')}}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group check-group-checkout" >
                                                <div class="col-md-6">
                                                    <label for="Gender" class="control-label">Gender</label>
                                                    <div class="check-row">
                                                        <div class="form-check-gender male">
                                                            <label class="form-check-label">
                                                                <input type="radio" name="gender" value="male">&nbsp;&nbsp;Male
                                                            </label>
                                                        </div>
                                                        <div class="form-check-gender">
                                                            <label class="form-check-label">
                                                                <input type="radio" name="gender" value="female">&nbsp;&nbsp;Female
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @if($errors->first('gender'))
                                                        <p class="error">{{$errors->first('gender')}}</p>
                                                    @endif

                                                </div>
                                                <div class="col-md-6">
                                                    <label>Street</label>
                                                    <input type="text" id="street" name="street" class="form-control <?php echo ($errors->has('street') ? ' is-invalid' : '')?>">
                                                    @if($errors->first('street'))
                                                        <p class="error">{{$errors->first('street')}}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label>Landmark</label>
                                                    <input type="text" id="landmark" name="landmark" class="form-control <?php echo ($errors->has('landmark') ? ' is-invalid' : '')?>">
                                                    @if($errors->first('landmark'))
                                                        <p class="error">{{$errors->first('landmark')}}</p>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Pincode</label>
                                                    <input type="number" id="pincode" name="pincode" class="form-control <?php echo ($errors->has('pincode') ? ' is-invalid' : '')?>">
                                                    @if($errors->first('pincode'))
                                                        <p class="error">{{$errors->first('pincode')}}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>Address </label>
                                                    <textarea class="form-control <?php echo ($errors->has('address') ? ' is-invalid' : '')?>" rows="5" id="address" name="address"></textarea>
                                                    @if($errors->first('address'))
                                                        <p class="error">{{$errors->first('address')}}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <span class="remember-box checkbox">
                                                        <label>
                                                            <input type="checkbox" checked="checked" id="is_default" name="is_default">Make this my default address
                                                        </label>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <input type="submit" value="Save"  class="btn pull-right btn-save-address btn-primary">
                                                </div>
                                            </div>
                                        {!! Form::close() !!}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                       3. Review Order
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="accordion-body collapse" style="height: 0px;">
                                <div class="panel-body">
                                    @if($cartItems->count())
                                        {!! Form::open(['route'=>'checkout.updateCart','id'=>'form-cart']) !!}
                                            <div class="container cart-popup">
                                                <table class="table listproducts table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-center">Items</td>
                                                        <td class="text-center">Unit Price</td>
                                                        <td class="text-center">Quantity(Kg)</td>
                                                        <td class="text-center">Sub Total</td>
                                                        <td class="text-center">Delete</td>
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
                                                            <span id="checkout_qty_updater" class="minus"><i
                                                                        class="fa fa-minus"></i></span>
                                                                <input readonly min="1" type="number" value="{{ $cartItem->qty }}"
                                                                       name="qty[{{$cartItem->id}}]" id="product_qty" class="qty"
                                                                       autocomplete="off"/>
                                                                <span id="checkout_qty_updater" class="plus add"><i class="fa fa-plus"></i></span>
                                                                <input type="hidden" name="product_id" value="1"/>
                                                            </p>
                                                        </td>
                                                        <td class="text-center">{!! $cartItem->getProductFormattedTotal() !!}</td>
                                                        <td class="text-center">
                                                            <a alt="Delete" title="Delete" href="{{route('checkout.deleteCartItem',$cartItem->id)}}"><i class="fa fa-trash" aria-hidden="true"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="3" class="text-center">Grand Total</td>
                                                    <td colspan="2" class="text-center">{!! $_cart->grandTotal(true) !!}</td>
                                                    <td></td>
                                                </tr>
                                                </tbody>
                                                </table>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="submit" id="update_shopping_cart" value="Update Shopping Cart" class="btn pull-left btn-primary">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="button" id="proceed_to_payment" value="Proceed to Payment" class="btn pull-right btn-primary">
                                                </div>
                                            </div>

                                        {!! Form::close() !!}
                                    @endif
                                </div>
                            </div>
                        </div>
                        {!! Form::open(['route' => 'checkout.postCheckout','id'=>'checkOutForm']) !!}
                            <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                       4. Make Payment
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFour" class="accordion-body collapse" style="height: 0px;">
                                <div class="panel-body">
                                    <h4 class="heading-primary">Payment</h4>
                                    <div class="radio">
                                        <label><input type="radio" name="payment_method" checked value="COD" class="payment_mode_radio"><img src="{{ asset('img/icon/cod.jpg') }}" height="50" width="100"></label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="payment_method" value="CCAvenue" class="payment_mode_radio"><img src="{{ asset('img/icon/ccavenue.png') }}" height="50" width="100"></label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="payment_method" value="Paytm" class="payment_mode_radio"><img src="{{ asset('img/icon/paytm.png') }}" height="50" width="100"></label>
                                    </div>
                                    <div class="pull-right">
                                        <input type="submit" value="Place Order" name="proceed" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                        </div>
                            {{--hidden field used to get address id when user click on delivery area button in li tag--}}
                            {!! Form::hidden('delivery_address_id',$address_id) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="checkout-right col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <h4 class="title">Order Summary</h4>
                    <table class="table cart-total">
                        <tbody>
                        <tr class="total">
                            <th>
                                <span>
                                    Subtotal Excl.Tax
                                </span>
                            </th>
                            <td>
                                <span class="amount">{!! $_cart->getSubTotal(true) !!}</span>
                            </td>
                        </tr>
                        <tr class="total">
                            <th>
                               <span>
                                   Subtotal Incl.Tax
                               </span>
                            </th>
                            <td>
                               <span class="amount">{!! $_cart->getSubTotal(true) !!}</span>
                            </td>
                        </tr>
                        <tr class="shipping">
                            <th>
                                <span>Shipping</span>
                            </th>
                            <td>
                                <span class="shipping-free">Free</span>
                            </td>
                        </tr>
                        <tr class="discount">
                            <th>
                                <span>Discount</span>
                            </th>
                            <td>
                                <span class="discount">{!! $_cart->getDiscount(true) !!}</span>
                            </td>
                        </tr>
                        <tr class="tax">
                            <th>
                                <span>Tax</span>
                            </th>
                            <td>
                                <span class="tax">0</span>
                            </td>
                        </tr>
                        <tr class="total">
                            <th>
                                <span>Order Total</span>
                            </th>
                            <td>
                                <span class="amount">{!! $_cart->grandTotal(true) !!}</span>
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