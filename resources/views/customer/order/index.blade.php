@extends('customer.layout')

@section('tab-content')

    <div class="orders">
        <h2>My Orders</h2>

        <div class="row order-content">
            <div class="col-md-6 col-lg-8 col-sm-6 col-12 left-side">
                <h4>order n<sup>o</sup> 0000122</h4>
                <p><span>Delivered to :</span> customer name</p>
                <p><span>Order status :</span> In progress</p>
            </div>
            <div class="col-md-6 col-lg-4 col-sm-6 col-12 right-side">
                <p><span>Date :</span> 03/01/2018</p>
                <a href="{{ route('customer.order.detail') }}">view order</a>
            </div>
        </div>

        <div class="row order-content">
            <div class="col-md-6 col-lg-8 col-sm-6 col-12 left-side">
                <h4>order n<sup>o</sup> 0000123</h4>
                <p><span>Delivered to :</span> customer name</p>
                <p><span>Order status :</span> In progress</p>
            </div>
            <div class="col-md-6 col-lg-4 col-sm-6 col-12 right-side">
                <p><span>Date :</span> 03/01/2018</p>
                <a href="{{ route('customer.order.detail') }}">view order</a>
            </div>
        </div>

        <div class="row order-content">
            <div class="col-md-6 col-lg-8 col-sm-6 col-12 left-side">
                <h4>order n<sup>o</sup> 0000124</h4>
                <p><span>Delivered to :</span> customer name</p>
                <p><span>Order status :</span> In progress</p>
            </div>
            <div class="col-md-6 col-lg-4 col-sm-6 col-12 right-side">
                <p><span>Date :</span> 03/01/2018</p>
                <a href="{{ route('customer.order.detail') }}">view order</a>
            </div>
        </div>

    </div>

@endsection