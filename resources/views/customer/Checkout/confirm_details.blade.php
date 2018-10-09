@extends('template.1column')
@section('content')
    <!-- Main Content -->
    <div id="checkout-main-content" class="site-content">
        <div class="container">
            <div class="row ">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <h3 class="title">Your order has been completed successfully</h3>
                    {!! Form::open(['route' => 'home']) !!}
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
                                 <strong>Sub Total</strong>
                             </td>
                             <td>
                                 {{$order->sub_total}}
                             </td>

                         </tr>
                         <tr>
                             <td>
                                 <strong>Tax</strong>
                             </td>
                             <td>
                                 {{$order->tax}}
                             </td>

                         </tr>
                         <tr>
                             <td>
                                 <strong>Discount</strong>
                             </td>
                             <td>
                                 {{$order->discount}}
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
                            <input type="button" id="proceed_to_payment" value="Proceed to Payment" class="btn pull-right btn-primary">
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </div>
@endsection