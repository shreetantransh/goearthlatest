@extends('admin.layout.edit')

@section('title')
    <div class="block-header">
        <h2>{{ $attribute_set->id ? 'UPDATE' : 'ADD NEW' }} ATTRIBUTE SET</h2>
    </div>
@endsection

@section('form')

    @if($attribute_set->id)
        {!! Form::model($attribute_set, ['method' => 'put', 'route' => ['admin.catalog.attributes.attribute-set.update', $attribute_set->id]]) !!}
    @else
        {!! Form::open(['route' => 'admin.catalog.attributes.attribute-set.store']) !!}
    @endif

    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="header">
                    <h2>GENERAL INFORMATION</h2>
                </div>
                <div class="body">

                    <div class="form-group">
                        {!! Form::materialText('Name', 'name', old('name', $attribute_set->name), $errors->first('name')) !!}
                    </div>
                </div>
            </div>

        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="header">
                    <h2>ADDITIONAL INFORMATION</h2>
                </div>
                <div class="body">
                    <button id="save" type="submit" class="btn btn-primary btn-lg waves-effect">SAVE</button>
                    @if($attribute_set->id)
                        <button data-delete-url="" id="delete" type="button" class="btn btn-danger btn-lg waves-effect">
                            DELETE
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    @if($attribute_set->id)
        {!! Form::open(['url' => route('admin.catalog.attributes.attribute-set.destroy', $attribute_set->id), 'method' => 'delete', 'id' => 'delete']) !!}
        {!! Form::close() !!}
    @endif
@endsection

@push('scripts')
    <script type="text/javascript">

        $(document).ready(function () {
            $("#delete").on('click', function () {

                var _self = $(this);

                swal({
                    title: "Are you sure?",
                    text: "You are about to delete this attribute_set",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                }, function () {
                    $('form#delete').submit();
                });
            });
        });

    </script>
@endpush