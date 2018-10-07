@extends('admin.layout.edit')

@section('title')
    <div class="block-header">
        <h2>{{ $category->id ? 'UPDATE' : 'ADD NEW' }} CATEGORY</h2>
    </div>
@endsection

@section('form')

    {!! Form::open(['files' => true]) !!}

    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="header">
                    <h2>GENERAL INFORMATION</h2>
                </div>
                <div class="body">

                    <div class="form-group">
                        {!! Form::materialText('Name', 'name', old('name', $category->name), $errors->first('name')) !!}
                    </div>

                    @if($category->slug)
                        <div class="form-group">
                            {!! Form::materialText('Slug', 'slug', old('slug', $category->slug), $errors->first('slug')) !!}
                        </div>
                        @endif

                    @if($categories->count())

                        <div class="form-group">
                            <select class="form-control show-tick" id="parent_category" name="parent_category">
                                <option value="">Child Of</option>
                                @include('admin.catalog.category.multi-category', ['categories' =>  $categories, 'dash' => '', 'selected' => [$category->parent_id]])
                            </select>
                        </div>

                    @endif

                    <div class="form-group">
                        {!! Form::materialTextArea('Description', 'description', old('description', $category->description), $errors->first('description')) !!}
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="header">
                    <h2>META INFORMATION</h2>
                </div>
                <div class="body">

                    <div class="form-group">
                        {!! Form::materialText('Title', 'meta_title', old('meta_title', $category->meta_title), $errors->first('meta_title')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::materialTextArea('Keywords', 'meta_keywords', old('meta_keywords', $category->meta_keywords), $errors->first('meta_keywords'), ['rows' => 3]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::materialTextArea('Description', 'meta_description', old('meta_description', $category->meta_description), $errors->first('meta_description'), ['rows' => 3]) !!}
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
                    @if($category->image)
                        <div class="show-icon">
                            <img src="{{ $category->getImage() }}" alt="" class="img-responsive">
                        </div>
                    @endif
                    <div class="form-group">
                        {!! Form::materialFile($category->icon?'Change Image':'Upload Image', 'icon', $errors->first('icon')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::checkbox('is_active', 1, old('is_active', $category->is_active), ['class' => 'filled-in chk-col-blue', 'id' => 'is_active']) !!}
                        <label for="is_active">Publish</label>
                    </div>

                    <div class="form-group">
                        {!! Form::checkbox('add_to_menu', 1, old('add_to_menu', $category->add_to_menu), ['class' => 'filled-in chk-col-blue', 'id' => 'add_to_menu']) !!}
                        <label for="add_to_menu">Add to menu</label>
                    </div>

                    <button id="save" type="submit" class="btn btn-primary btn-lg waves-effect">SAVE</button>
                    @if($category->id)
                        <button data-delete-url="" id="delete" type="button" class="btn btn-danger btn-lg waves-effect">
                            DELETE
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    @if($category->id)
        {!! Form::open(['url' => route('admin.catalog.category.delete', $category->slug), 'method' => 'delete', 'id' => 'delete']) !!}
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
                    text: "You are about to delete this category",
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