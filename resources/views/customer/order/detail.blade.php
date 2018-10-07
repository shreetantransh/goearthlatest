@extends('customer.layout')

@section('tab-content')

    <div class="orders">
        <h2>order detail</h2>

        <div class="row">
            <div class="col-lg-10 col-md-12">
                <div class="order-detail">
                    <div class="row">
                        <div class="col col-12 col-lg-6 col-md-6 col-sm-6">
                            <div class="shipping-address">
                                <h4>shipping address</h4>
                                <p>1 b-90, zinc colony, hurda, bhilwara<br> 311022, rajasthan,<br> IN</p>
                                <h4>shipping option</h4>
                                <p>france standard delivery: <i class="fa fa-inr" aria-hidden="true"></i>12.00</p>
                            </div>
                        </div>
                        <div class="col col-12 col-lg-6 col-md-6 col-sm-6">
                            <div class="total-amount">
                                <div class="subtotal">
                                    <p>subtotal:</p>
                                    <span><i class="fa fa-inr" aria-hidden="true"></i>2000.00</span>
                                </div>
                                <div class="shipping-cost">
                                    <p>shipping cost:</p>
                                    <span><i class="fa fa-inr" aria-hidden="true"></i>2000.00</span>
                                </div>
                                <div class="order-discount">
                                    <p>order discount:</p>
                                    <span><i class="fa fa-inr" aria-hidden="true"></i>2000.00</span>
                                </div>
                                <div class="total-cost">
                                    <p>total</p>
                                    <span><i class="fa fa-inr" aria-hidden="true"></i>2000.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wishlist-content">
                    <div class="row">
                        <div class="col col-auto">
                            <img src="../../images/trending/trending1.jpg" alt="Praesentium quia." class="img-fluid">
                        </div>
                        <div class="col">
                            <h4>Praesentium quia.</h4>
                            <div class="favourite-price">
                                <div class="product-price">
                                    <span class="regular-price"><i class="fa fa-inr"></i>337,621,114</span>
                                    <span class="special-price"><i class="fa fa-inr"></i>79,952,545</span>
                                </div>                                    </div>
                        </div>
                        <div class="col col-lg-3 d-flex flex-1 justify-content-end flex-column">
                            <div class="wishlist-footer">
                                <div class="shop-cart">
                                    <a href="" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tooltip on top">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    </a>
                                </div>
                                <div class="heart">
                                    <a href="" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tooltip on top">
                                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wishlist-content">
                    <div class="row">
                        <div class="col col-auto">
                            <img src="../../images/trending/trending1.jpg" alt="Praesentium quia." class="img-fluid">
                        </div>
                        <div class="col">
                            <h4>Praesentium quia.</h4>
                            <div class="favourite-price">
                                <div class="product-price">
                                    <span class="regular-price"><i class="fa fa-inr"></i>337,621,114</span>
                                    <span class="special-price"><i class="fa fa-inr"></i>79,952,545</span>
                                </div>                                    </div>
                        </div>
                        <div class="col col-lg-3 d-flex flex-1 justify-content-end flex-column">
                            <div class="wishlist-footer">
                                <div class="shop-cart">
                                    <a href="" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tooltip on top">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    </a>
                                </div>
                                <div class="heart">
                                    <a href="" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tooltip on top">
                                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection