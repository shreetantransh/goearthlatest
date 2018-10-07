@extends('admin.layout.grid')

@section('grid-title')
    <h2>
        CUSTOMER
    </h2>
@endsection


@section('grid-content')
    {!! $grid->render() !!}
@endsection