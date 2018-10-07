@extends('admin.layout.main')

@section('content')

    @yield('title')

    @include('admin.layout.partial.alert')

    @yield('form')

@endsection