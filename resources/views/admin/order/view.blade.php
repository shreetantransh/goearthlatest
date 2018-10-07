@extends('admin.layout.main')

@section('content')

    @include('admin.layout.partial.alert')

    <div class="block-header">
        <h2>Order#{{ $order->order_id  }}</h2>
    </div>


    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="header">
                    <h2 class="pull-left">Products Ordered</h2>
                    <a href="{{ route('admin.order.invoice', $order->id) }}" class="btn btn-primary pull-right"
                       class="pull-right">Print Invoice</a>
                    <br>
                </div>
                <div class="body">

                    @forelse($products as $product)
                        <div class="product-order-detials">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="{{ $product->getBaseImage(\App\Models\ProductImage::IMAGE_SMALL) }}"
                                         class="img img-responsive img-thumbnail">
                                </div>
                                <div class="col-md-9">
                                    <h5><a target="_blank"
                                           href="{{ route('admin.catalog.product.tab.product', $product->id) }}">{{ $product->getName(70) }}</a>
                                    </h5>
                                    <p class="price">{{ $product->getPrice() }}</p>

                                </div>
                            </div>

                        </div>


                    @empty
                        <p>Ordered products not found.</p>
                    @endforelse

                </div>
            </div>

            <div class="card">
                <div class="header">
                    <h2>Order Logs</h2>
                </div>
                <div class="body table-responsive">
                    @if($order->orderLogs->count())
                        <table class="table">
                            <thead>
                            <tr>

                                <th>Status</th>
                                <th>Comments</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($order->orderLogs()->orderBy('id', 'desc')->get() as $log)
                                <tr>

                                    <td>{{ $log->status }}</td>
                                    <td>{{ $log->comments }}</td>
                                    <td>{{ \Carbon\Carbon::parse($log->created_at)->format('F j, Y H:i A') }}</td>
                                </tr>
                            @empty
                                <p>Logs not found.</p>
                            @endforelse

                            </tbody>
                        </table>
                    @else
                        <p>Logs not found.</p>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="header">
                    <h2>Address</h2>
                </div>
                <div class="body">
                    @if($address)
                        <p>{{ $address->first_name }}</p>
                        <p>{{ $address->last_name }}</p>
                        <p>{{ $address->email }}</p>
                        <p>{{ $address->street }}</p>
                        <p>{{ $address->address }}</p>
                        <p{{ optional($address->city)->getName() }}</p>
                        <p>{{ optional($address->state)->getName() }}</p>
                        <p>{{ $address->pincode }}</p>
                        <p>Ph: {{ $address->mobile }}</p>
                        <p>Gender: {{ $address->gender }}</p>
                        <p>Landmark: {{ $address->landmark }}</p>
                    @endif

                </div>
            </div>




        </div>

        <div class="col-sm-6">

            <div class="card">
                <div class="header">
                    <h2>Order Detail</h2>
                </div>
                <div class="body">
                    <p><strong>Order Id</strong>: {{ $order->order_id }}</p>
                    <p><strong>Status</strong>: {{ $order->orderStatus() }} </p>
                    <p><strong>Order Date </strong>: {{ $order->created_at->format('F j, Y H:i s') }} </p>
                    @if($order->payment_mode == 'COD')
                        <p>Payment Mode: {{ $order->payment_mode }}</p>
                    @else
                        <p><strong>Payment Mode</strong>: {{ $order->payment_mode }}</p>
                        <p><strong>Transaction Id</strong>: {{ $order->transaction_id }}</p>
                    @endif
                    <p><strong>Is Paid</strong>: {{ $order->is_paid == true ? 'Yes' : 'No' }}</p>
                    <p><strong>Status: {{ $order->orderStatus() }}</strong></p>
                </div>
            </div>




            <div class="card">
                <div class="header">
                    <h2>Order Total</h2>
                </div>
                <div class="body">

                    <p>Subtotal: {!! $order->getSubtotal() !!}</p>
                    <p>Discount: -{!! $order->getDiscount() !!}</p>
                    <p><strong>Grand Total</strong>: {!! $order->getTotal() !!}</p>

                </div>
            </div>

            <div class="card">
                <div class="header">
                    <h2>Update Status</h2>
                </div>
                <div class="body">
                    <div class="row">
                        {!! Form::open(['method' => 'post']) !!}
                        <div class="col-md-9">
                            {{ Form::select('status', [
                                                0 => 'Pending',
                                                1 => 'Processing',
                                                2 => 'Shipped',
                                                3 => 'Canceled',
                                                4 => 'Completed'
                                            ], $order->status, ['class' => 'form-control input'])
                            }}
                            {{ Form::hidden('order', $order->id) }}
                        </div>
                        <div class="col-md-3">
                            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        @endsection

        @push('scripts')
            <script type="text/javascript">

                $(document).ready(function () {
                    $("#delete").on('click', function () {

                        var _self = $(this);

                        swal({
                            title: "Are you sure?",
                            text: "You are about to delete this category",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Yes, delete it!",
                            closeOnConfirm: false
                        }, function () {
                            $('form#delete').submit();
                        });
                    });
                });

            </script>
    @endpush