@extends('admin.layout.grid')

@section('grid-title')
    <h2>
        Voucher
    </h2>
@endsection

@section('grid-actions')
    <ul class="header-dropdown m-r--5">
        <li>
           <a class="btn btn-primary" href="{{ route('admin.voucher.create') }}"> Add Voucher</a>
        </li>
    </ul>
@endsection

@section('grid-content')
    {!! $grid->render() !!}
@endsection