@extends('template.1column')
@section('content')
    <!-- Main Content -->
    <div id="checkout-main-content" class="site-content">
        <div class="container custom-fancybox cart-popup">
             @if($cartItems->count())

                <div class="mycart">
                    <div class="container">
                        <div class="row ">
                            <div class="col-sm-9 col-md-9 col-lg-9">
                                <h3 class="text-center">Shopping Cart</h3>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="col-md-12 col-xs-6 col-sm-6 table-responsive">
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
                                                        <span id="qty_updater" class="minus"><i
                                                                    class="fa fa-minus"></i></span>
                                                            <input readonly min="1" type="number" value="{{ $cartItem->qty }}"
                                                                   name="qty[{{$cartItem->id}}]" id="product_qty" class="qty"
                                                                   autocomplete="off"/>
                                                            <span id="qty_updater" class="plus add"><i class="fa fa-plus"></i></span>
                                                            <input type="hidden" name="product_id" value="1"/>
                                                        </p>
                                                    </td>
                                                    <td class="text-center">{!! $cartItem->getProductFormattedTotal() !!}</td>
                                                    <td class="text-center">
                                                        <a type="button" data-content="{{$cartItem->id}}" id="itemDelete"><i class="fa fa-trash" aria-hidden="true"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="2" class="text-center">Grand Total</td>
                                                <td colspan="2" class="text-center">{!! $_cart->grandTotal(true) !!}</td>
                                                <td></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </form>
                                <div class="buttons">
                                    <a href="{{ route('home') }}" class="btn-primary btn">Continue shopping</a>
                                    <a href="{{ route('checkout.get-checkout') }}" class="btn-primary btn pull-right" >Proceed to Checkout </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3 colsm-3">
                                <h4 class="title">Order Summary</h4>
                                <table class="table cart-total">
                                    <tbody>
                                    <tr class="total">
                                        <th>
                                            <strong>Cart Subtotal Excl.Tax</strong>
                                        </th>
                                        <td>
                                            <strong><span class="amount">{!! $_cart->getSubTotal(true) !!}</span></strong>
                                        </td>
                                    </tr>
                                    <tr class="total">
                                        <th>
                                            <strong>Cart Subtotal Incl.Tax</strong>
                                        </th>
                                        <td>
                                            <strong><span class="amount">{!! $_cart->getSubTotal(true) !!}</span></strong>
                                        </td>
                                    </tr>
                                    <tr class="shipping">
                                        <th>
                                            <strong>Shipping</strong>
                                        </th>
                                        <td>
                                            <strong><span class="shipping">Free shipping</span></strong>
                                        </td>
                                    </tr>
                                    <tr class="discount">
                                        <th>
                                            <strong>Discount</strong>
                                        </th>
                                        <td>
                                            <strong><span class="discount">0</span></strong>
                                        </td>
                                    </tr>
                                    <tr class="tax">
                                        <th>
                                            <strong>Tax</strong>
                                        </th>
                                        <td>
                                            <strong><span class="tax">0</span></strong>
                                        </td>
                                    </tr>
                                    <tr class="total">
                                        <th>
                                            <strong>Order Total</strong>
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

            @else
                <div class="no-cart text-center">
                    <h3>Shopping cart</h3>
                    <p>Your shopping cart is empty.</p>
                    <a class="btn btn-primary" href="{{ url('') }}">Continue Shopping</a>
                </div>
            @endif
        </div>
    </div>
@endsection