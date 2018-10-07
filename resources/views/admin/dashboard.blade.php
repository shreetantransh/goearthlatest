@extends('admin.layout.main')

@section('content')

    <div class="block-header">
        <h2>DASHBOARD</h2>
    </div>

@endsection

@push('scripts')
    <script src="{{ url('admin/plugins/morrisjs/morris.js') }}"></script>
    <script src="{{ url('admin/js/pages/charts/morris.js') }}"></script>
    <script src="{{ url('admin/js/pages/index.js') }}"></script>
@endpush