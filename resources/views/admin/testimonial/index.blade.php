@extends('admin.layout.grid')

@section('grid-title')
    <h2>
        TESTIMONIAL
    </h2>
@endsection

@section('grid-actions')
    <ul class="header-dropdown m-r--5">
        <li>
           <a class="btn btn-primary" href="{{ route('admin.testimonial.create') }}"> Add Testimonial</a>
        </li>
    </ul>
@endsection

@section('grid-content')
    {!! $grid->render() !!}
@endsection