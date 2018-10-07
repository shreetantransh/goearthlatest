@extends('admin.layout.edit')

@section('title')
    <div class="block-header">
        <h2>{{ $banner->id ? 'UPDATE' : 'ADD NEW' }} ATTRIBUTE </h2>
    </div>
@endsection

@section('form')

    @if($banner->id)
        {!! Form::model($banner, ['method' => 'put', 'files' => true, 'route' => ['admin.banner.update', $banner->id]]) !!}
    @else
        {!! Form::open(['route' => 'admin.banner.store', 'files' => true]) !!}
    @endif

    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="header">
                    <h2>GENERAL INFORMATION</h2>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::materialText('Title', 'title', old('title', $banner->title), $errors->first('title')) !!}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::materialText('Button Title', 'button_title', old('button_title', $banner->button_title), $errors->first('button_title')) !!}
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::materialText('Url', 'url', old('url', $banner->url), $errors->first('url')) !!}
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::materialText('Sequence', 'sequence', old('sequence', $banner->sequence), $errors->first('sequence')) !!}
                            </div>
                        </div>

                        <div class="clarfix"></div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                {!! Form::materialTextArea('Content', 'content', old('content', $banner->content), $errors->first('content')) !!}
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                {!! Form::materialFile('Image', 'banner_image', $errors->first('banner_image')) !!}
                                @if($banner->image)
                                    <br>
                                    <img src="{{ $banner->getImage() }}" style="height: 50px">
                                    @endif
                            </div>
                        </div>

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
                        {!! Form::checkbox('is_active', 1, old('is_active', $banner->is_active), ['class' => 'filled-in chk-col-blue', 'id' => 'is_active']) !!}
                        <label for="is_active">Publish</label>
                    </div>

                    <button id="save" type="submit" class="btn btn-primary btn-lg waves-effect">SAVE</button>
                    @if($banner->id)
                        <button data-delete-url="" id="delete" type="button" class="btn btn-danger btn-lg waves-effect">
                            DELETE
                        </button>
                    @endif
                </div>
            </div>

            <div class="card" id="typeAttributes" style="display: none">
                <div class="header">
                    <h2>Attribute Types
                        <button class="btn btn-sm btn-primary add_more_button pull-right">Add More</button>
                    </h2>
                </div>

            </div>
        </div>

    </div>
    </div>
    {!! Form::close() !!}

    {!! Form::open(['route' => ['admin.banner.delete', $banner->id], 'method' => 'delete', 'id' => 'delete']) !!}
    {!! Form::close() !!}
@endsection

@push('scripts')



    <script type="text/javascript">

        $(document).ready(function () {

            showBox(jQuery("#type").val());

            jQuery("#type").on('change', function () {

                var thisVal = jQuery(this).val();

                showBox(thisVal);
            });

            function showBox(thisVal) {
                if (thisVal == 'dropdown' || thisVal == 'checkbox' || thisVal == 'radio' | thisVal == 'multiselect') {
                    jQuery("#typeAttributes").show();
                } else {
                    jQuery("#typeAttributes").hide();
                }
            }


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