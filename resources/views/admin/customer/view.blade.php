@extends('admin.layout.main')

@section('content')

    @include('admin.layout.partial.alert')




    <div class="row">
        <div class="col-sm-6">

            <div class="card">
                <div class="header">
                    <h2>Customer Details</h2>
                </div>
                <div class="body">
                    <p><strong>Name</strong>: {{ $customer->getFullName() }}</p>
                    <p><strong>Email</strong>: {{ $customer->email }} </p>
                    <p><strong>Mobile Number </strong>: {{ $customer->created_at->format('F j, Y H:i s') }} </p>
                    <p><strong>Gender</strong>: {{ $customer->gender }}</p>
                    <p><strong>DOB</strong>: {{  $customer->dob }}</p>
                    <p><strong>Is Guest User</strong>: {{ $customer->is_guest_customer ? 'Yes' : 'No' }}</p>
                    <p><strong>Created At</strong>: {{ $customer->created_at->format('F j, Y H:i s') }}</p>

                </div>
            </div>


            <div class="card">
                <div class="header">
                    <h2>Orders</h2>
                </div>
                <div class="body table-responsive">
                    @if($customer->orders->count())
                        <table class="table">
                            <thead>
                            <tr>

                                <th>Order Id</th>
                                <th>Sub Total</th>
                                <th>Discount</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($customer->orders()->orderBy('id', 'desc')->get() as $order)
                                <tr>

                                    <td><a href="{{ route('admin.order.view', $order->id) }}" target="_blank">#{{ $order->order_id }}</a></td>
                                    <td>{!! $order->getSubTotal() !!}</td>
                                    <td>{!! $order->getDiscount() !!}</td>
                                    <td>{!! $order->getTotal() !!}</td>
                                </tr>
                            @empty
                                <p>Logs not found.</p>
                            @endforelse

                            </tbody>
                        </table>
                    @else
                        <p>Customer have not order any product yet.</p>
                    @endif
                </div>
            </div>

        </div>

        <div class="col-sm-6">
            @if($customer->addresses)
                <div class="card">
                    <div class="header">
                        <h2>Address</h2>
                    </div>
                    <div class="body">
                        <div class="row">
                        @foreach($customer->addresses as $address)
                            <div class="col-md-6">


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
                        @endforeach
                        </div>
                    </div>
                </div>
            @endif
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