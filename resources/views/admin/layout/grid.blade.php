@extends('admin.layout.main')

@section('content')

    @include('admin.layout.partial.alert')

    <div class="card">
        <div class="header clearfix">
            @yield('grid-title')
            @yield('grid-actions')
        </div>
        @yield('grid-content')
    </div>
@endsection
