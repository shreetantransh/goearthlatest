@extends('admin.layout.grid')

@section('grid-title')
    <h2 class="pull-left">
        ATTRIBUTES
        <small>ATTRIBUTE SET</small>
    </h2>
@endsection

@section('grid-actions')
    <a class="btn btn-primary pull-right btn-lg" href="{{ route('admin.catalog.attributes.attribute.create') }}">
        <i class="material-icons">add</i>
        <span>Create New</span>
    </a>
@endsection

@section('grid-content')
    {!! $grid->render() !!}
@endsection