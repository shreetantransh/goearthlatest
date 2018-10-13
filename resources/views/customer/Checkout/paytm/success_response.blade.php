@extends('template.1column')
@section('content')
    <!-- Main Content -->
    <div id="checkout-main-content" class="site-content">
        <div class="container">
            <div class="row ">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <h3 class="title">Your order has been completed successfully!</h3>
                    <table class="table listproducts">
                        <tbody>
                            <tr>
                                <td>
                                    <strong>Order Id</strong>
                                </td>
                                <td>
                                    {{$order->id}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Transaction Id</strong>
                                </td>
                                <td>
                                    {{$order->transaction_id}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Payment Status</strong>
                                </td>
                                <td>
                                    {{($order->is_paid == 1)?'Paid':'Unpaid'}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Total Amount</strong>
                                </td>
                                <td>
                                    {{$order->total}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Payment Mode</strong>
                                </td>
                                <td>
                                    {{$order->payment_mode}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <div class="col-md-12">
                            <a type="button" href="{{url('')}}"  class="btn pull-right btn-primary">Continue Shopping </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </div>
@endsection