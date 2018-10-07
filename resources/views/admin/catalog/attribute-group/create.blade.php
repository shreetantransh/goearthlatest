@extends('admin.layout.edit')

@section('title')
    <div class="block-header">
        <h2>{{ $attribute_group->id ? 'UPDATE' : 'ADD NEW' }} ATTRIBUTE GROUP</h2>
    </div>
@endsection

@section('form')

    @if($attribute_group->id)
        {!! Form::model($attribute_group, ['method' => 'put', 'route' => ['admin.catalog.attributes.attribute-group.update', $attribute_group->id]]) !!}
    @else
        {!! Form::open(['route' => 'admin.catalog.attributes.attribute-group.store']) !!}
    @endif

    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="header">
                    <h2>GENERAL INFORMATION</h2>
                </div>
                <div class="body">

                    <div class="form-group">
                        {!! Form::materialSelect('Attribute Set', 'attribute_set_id', $attribute_sets , $attribute_group->attribute_set_id, $errors->first('attribute_set_id')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::materialText('Group Name', 'name', old('name', $attribute_group->name), $errors->first('name')) !!}
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
                    @if($attribute_group->id)
                        <button data-delete-url="" id="delete" type="button" class="btn btn-danger btn-lg waves-effect">
                            DELETE
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

    @if($attribute_group->id)
        {!! Form::open(['url' => route('admin.catalog.attributes.attribute-group.destroy', $attribute_group->id), 'method' => 'delete', 'id' => 'delete']) !!}
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