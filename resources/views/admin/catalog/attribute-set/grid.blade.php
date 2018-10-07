@extends('admin.layout.grid')

@section('grid-title')
    <h2>
        ATTRIBUTES
        <small>ATTRIBUTE SET</small>
    </h2>
@endsection

@section('grid-actions')
    <ul class="header-dropdown m-r--5">
        <li class="dropdown">
            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
               aria-haspopup="true" aria-expanded="false">
                <i class="material-icons">more_vert</i>
            </a>
            <ul class="dropdown-menu pull-right">
                <li><a href="{{ route('admin.catalog.attributes.attribute-set.create') }}">Create New</a></li>
            </ul>
        </li>
    </ul>
@endsection

@section('grid-content')
    {!! $grid->render() !!}
@endsection