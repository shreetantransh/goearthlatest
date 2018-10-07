@extends('admin.layout.edit')

@section('title')
    <div class="block-header">
        <h2>{{ $page->id ? 'UPDATE' : 'ADD NEW' }} PAGE</h2>
    </div>
@endsection

@section('form')

    {!! Form::open() !!}

    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="header">
                    <h2>GENERAL INFORMATION</h2>
                </div>
                <div class="body">

                    <div class="form-group">
                        {!! Form::materialText('Name', 'name', old('name', $page->name), $errors->first('name')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::materialText('Slug', 'slug', old('slug', $page->slug), $errors->first('slug')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::materialTextArea('Content', 'content', old('content', $page->content), $errors->first('content')) !!}
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="header">
                    <h2>META INFORMATION</h2>
                </div>
                <div class="body">

                    <div class="form-group">
                        {!! Form::materialText('Title', 'meta_title', old('meta_title', $page->meta_title), $errors->first('meta_title')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::materialTextArea('Keywords', 'meta_keywords', old('meta_keywords', $page->meta_keywords), $errors->first('meta_keywords'), ['rows' => 3]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::materialTextArea('Description', 'meta_description', old('meta_description', $page->meta_description), $errors->first('meta_description'), ['rows' => 3]) !!}
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

                    <div class="form-group">
                        {!! Form::materialSelect('Template', 'template', \App\Models\Page::getPageTemplates()->pluck('label', 'value'), old('template', $page->template), $errors->first('template')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::checkbox('is_active', 1, old('is_active', $page->is_active), ['class' => 'filled-in chk-col-blue', 'id' => 'is_active']) !!}
                        <label for="is_active">Publish</label>
                    </div>

                    <button id="save" type="submit" class="btn btn-primary btn-lg waves-effect">SAVE</button>
                    @if($page->id)
                        <button data-delete-url="" id="delete" type="button" class="btn btn-danger btn-lg waves-effect">
                            DELETE
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

    @if($page->id)
        {!! Form::open(['url' => route('admin.cms.page.delete', $page->id), 'method' => 'delete', 'id' => 'delete']) !!}
        {!! Form::close() !!}
    @endif

@endsection

@push('scripts')

    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({selector: 'textarea'});</script>
    <script type="text/javascript">

        $(document).ready(function () {
            $("#delete").on('click', function () {

                var _self = $(this);

                swal({
                    title: "Are you sure?",
                    text: "You are about to delete this page",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                }, function () {
                    $('form#delete').submit();
                });
            });

            @if(!$page->id)
            $('#name').on('keyup blur', function () {

                var inputVal = $(this).val();

                $('#slug').val(inputVal.replace(/([^A-Za-z0-9]+)/g, '-').toLowerCase());
                $('#meta_title').val(inputVal + ' - {{ config('app.name') }}');
            })
            @endif
        });

    </script>
@endpush