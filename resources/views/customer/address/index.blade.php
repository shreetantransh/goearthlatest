@extends('customer.layout')

@section('tab-content')

<div class="addresses">

    <div class="row">

        @if($addresses->count())
        @foreach($addresses as $key => $address)
        <div class="col-md-6 col-lg-6 col-sm-12 col-1">


            <div class="">
             <h2 class="custome-heading">Delivery Address</h2>

             <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $key }}">
                        <span class="col-md-6">{{ $address->first_name }} &nbsp; {{ $address->last_name }}
                        </span>
                        <span class="col-md-6 "> <div class="address-footer text-right">
                            <a class="btn btn-info" href="{{ route('customer.address.edit', $address->id) }}" data-toggle="tooltip" data-placement="top" title="edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a  class="btn btn-danger" href="javascript: void(0)" data-toggle="tooltip" data-placement="top" title="delete" id="addressDelete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            {{ Form::open(['route' => ['customer.address.destroy', $address->id], 'method' => 'delete', 'id' => 'formDelete']) }}
                            {{ Form::close() }}
                        </div></span> </a>
                  </h4>
              </div>
              <div id="collapse1{{ $key }}" class="panel-collapse collapse in">
                <div class="panel-body">
                    <div class="shipping-address">
                        <p class="address-hearder"><strong>{{ $address->first_name }} &nbsp; {{ $address->last_name }} </strong></p>
                        <p>{{ $address->email }}</p>
                        <p>{{ $address->street }}</p>
                        <p>{{ $address->address }}</p>
                        <p>{{ optional($address->city)->getName() }}</p>
                        <p>{{ optional($address->state)->getName() }}</p>
                        <p>{{ $address->pincode }}</p>
                        <p>Ph:<strong> {{ $address->mobile }} </strong></p>
                        <p>Landmark: {{ $address->landmark }}</p>
                        
                    </div>
                </div>
            </div>
        </div>


    </div> 
</div>





</div>
@endforeach
@endif


<div class="col-md-6 col-lg-4 col-sm-6 col-12">
    <a href="{{ route('customer.address.create') }}" class="add-address">
     <div class="address-content">
        <i class="fa fa-plus" aria-hidden="true"></i>
        <span>Add a New Address</span>
    </div>
</a>
</div>
</div>
</div>

@endsection