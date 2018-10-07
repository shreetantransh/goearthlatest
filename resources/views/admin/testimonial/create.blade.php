@extends('admin.layout.edit')

@section('title')
    <div class="block-header">
        <h2>{{ $testimonial->id ? 'UPDATE' : 'ADD NEW' }} TESTIMONIAL </h2>
    </div>
@endsection

@section('form')

    @if($testimonial->id)
        {!! Form::model($testimonial, ['method' => 'put', 'route' => ['admin.testimonial.update', $testimonial->id], 'files' => true]) !!}
    @else
        {!! Form::open(['route' => 'admin.testimonial.store', 'files' => true, 'method' => 'POST']) !!}
    @endif

    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="header">
                    <h2>GENERAL INFORMATION</h2>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                {!! Form::materialText('Name', 'name', old('name', $testimonial->name), $errors->first('name')) !!}
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                {!! Form::materialTextArea('Comment', 'comment', old('comment', $testimonial->comment), $errors->first('comment')) !!}
                            </div>
                        </div>

                        <div class="col-sm-12">
                        <div class="col-sm-12">
                            <div class="form-group">
                                {!! Form::materialText('Sequence', 'sequence', old('sequence', $testimonial->sequence), $errors->first('sequence')) !!}
                            </div>
                        </div>

                        <div class="col-sm-12">
                            {!! Form::materialFile('Image', 'image', $errors->first('image')) !!}
                            @if($testimonial->image)
                                <br>
                                <img src="{{ $testimonial->getImageUrl() }}" style="height: 50px">
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
                        {!! Form::checkbox('status', 1, old('status', $testimonial->status), ['class' => 'filled-in chk-col-blue', 'id' => 'status']) !!}
                        <label for="status">Publish</label>
                    </div>

                    <button id="save" type="submit" class="btn btn-primary btn-lg waves-effect">SAVE</button>
                    @if($testimonial->id)
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

    {!! Form::open(['route' => ['admin.testimonial.destroy', $testimonial->id], 'method' => 'delete', 'id' => 'delete']) !!}
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

            jQuery("#type").on('change', function () {

                var txt = jQuery("#type option:selected" ).text();
                if(jQuery("#type option:selected" ).val() != '')
                {
                    jQuery("#amount").closest('.form-group').find('label').html(txt);
                }

            });

        });

    </script>




@endpush