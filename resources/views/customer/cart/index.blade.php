@if( empty($excludeContainer))
    <div class="container custom-fancybox cart-popup">
        @endif
        @if($cartItems->count())
            <h3 class="text-center">Shopping Cart</h3>
            <div class="mycart">
                <div class="container">
                    <div class="row ">
                        <div class="col-sm-12">
                            <form method="post" enctype="multipart/form-data">
                                <div class="col-md-12 col-xs-6 col-sm-6 table-responsive">
                                    <table class="table table-bordered listproducts">
                                        <thead>
                                        <tr>
                                            <td class="text-left">Items</td>
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
                                            <td colspan="2">Grand Total</td>
                                            <td colspan="2" class="text-right">{!! $_cart->grandTotal(true) !!}</td>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-12">
                            <div class="buttons">
                                <a href="{{ route('checkout.cart') }}" class="btn-primary btn">View Cart</a>
                                <a href="{{ route('checkout.get-checkout') }}" class="btn-primary btn pull-right" >Proceed to Checkout </a>
                            </div>
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

        @if( empty($excludeContainer))
    </div>
@endif

