@extends('customer.layout')

@section('tab-content')


   <div class="dashboard">
       <span class="custome-heading">My Dashboard</span>
       <div class="customer-name">
           <h5>Hello, {{ auth('customer')->user()->getFullName() }}!</h5>
           <p>In your account dashboard you can view details of all your order activity with Go earth.
               You check order status, reorder from previous orders and initiate cancellations and returns for open orders.</p>
       </div>
       <div class="no-items">
           <p>YOU CURRENTLY HAVE NO ORDER IN YOUR ACCOUNT.</p>
       </div>
   </div>

@endsection