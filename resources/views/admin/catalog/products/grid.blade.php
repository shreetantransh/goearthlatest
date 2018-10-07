@extends('admin.layout.grid')

@section('grid-title')
    <h2 class="pull-left">
        PRODUCTS
        <small>CATALOG PRODUCTS</small>
    </h2>
@endsection

@section('grid-actions')
    <a class="pull-right btn btn-primary" href="{{ route('admin.catalog.product.create') }}">Create New</a>
@endsection

@section('grid-content')
    {!! $grid->render() !!}
@endsection