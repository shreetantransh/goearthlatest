@extends('admin.layout.edit')

@section('title')
    <div class="block-header">
        <h2>{{ $attribute->id ? 'UPDATE' : 'ADD NEW' }} ATTRIBUTE </h2>
    </div>
@endsection

@section('form')

    @if($attribute->id)
        {!! Form::model($attribute, ['method' => 'put', 'route' => ['admin.catalog.attributes.attribute.update', $attribute->id]]) !!}
    @else
        {!! Form::open(['route' => 'admin.catalog.attributes.attribute.store']) !!}
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
                                {!! Form::materialText('Label', 'label', old('label', $attribute->label), $errors->first('label')) !!}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::materialText('Code', 'code', old('code'), $errors->first('code')) !!}
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                {!! Form::materialSelect('Type', 'type', attributeType(), old('type'), $errors->first('type')) !!}
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                {!! Form::materialBoolean('Is Required', 'is_required', old('is_required'), $errors->first('is_required')) !!}
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                {!! Form::materialBoolean('Is Unique', 'is_unique', old('is_unique'), $errors->first('is_required')) !!}
                            </div>
                        </div>

                        <div class="clarfix"></div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::materialBoolean('Is Comparable', 'is_comparable', old('is_comparable'), $errors->first('is_comparable')) !!}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::materialBoolean('Is Searchable', 'is_searchable', old('is_searchable'), $errors->first('is_searchable')) !!}
                            </div>
                        </div>

                        <div class="clarfix"></div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::materialBoolean('Used in product listing', 'used_in_product_listing', old('used_in_product_listing'), $errors->first('used_in_product_listing')) !!}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::materialBoolean('Used in product detail', 'used_in_product_detail', old('used_in_product_detail'), $errors->first('used_in_product_detail')) !!}
                            </div>
                        </div>

                        <div class="clarfix"></div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::materialBoolean('Used in product sorting', 'used_in_product_sorting', old('used_in_product_sorting'), $errors->first('used_in_product_sorting')) !!}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::materialText('Sequence', 'sequence', old('sequence'), $errors->first('sequence')) !!}
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
                    <button id="save" type="submit" class="btn btn-primary btn-lg waves-effect">SAVE</button>
                    @if($attribute->id)
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
                <div class="body">


                    <div class="input_fields_container">

                        @if($attribute->hasMultiOptions())


                            @forelse(old('option_value', $attribute->options()->pluck('option_value')) as $key => $option)

                                <div class="row">

                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input class="form-control input" type="text" value="{{ $option }}"
                                                       name="option_value[]"
                                                       placeholder="Option Value">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input class="form-control input"
                                                       value="{{ old('option_sequence.' . $key) ? old('option_sequence.' . $key) : $key }}"
                                                       type="text"
                                                       name="option_sequence[]"
                                                       placeholder="Sequence">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <a href="javascrip: void(0)" class="remove_field"><i class="material-icons">delete_forever</i></a>
                                    </div>
                                </div>

                                @endforeach
                    </div>
                    @else
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control input" type="text"
                                               name="option_value[]"
                                               placeholder="Option Value">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control input" type="text"
                                               name="option_sequence[]"
                                               placeholder="Sequence">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <a href="javascrip: void(0)" class="remove_field"><i
                                            class="material-icons">delete_forever</i></a>
                            </div>
                        </div>

                    @endif

                </div>
            </div>
        </div>

    </div>
    </div>
    {!! Form::close() !!}

    @if( ! empty($attribute->id) )
        {!! Form::open(['url' => route('admin.catalog.attributes.attribute.destroy', $attribute->id), 'method' => 'delete', 'id' => 'delete']) !!}
        {!! Form::close() !!}
    @endif
@endsection

@push('scripts')

    <script>
        $(document).ready(function () {
            var max_fields_limit = 100; //set limit for maximum input fields
            var x = 1; //initialize counter for text box
            $('.add_more_button').click(function (e) { //click event on add more fields button having class add_more_button
                e.preventDefault();
                if (x < max_fields_limit) { //check conditions
                    x++; //counter increment
                    $('.input_fields_container').append('<div class="row">\n' +
                        '                            <div class="col-md-5">\n' +
                        '                                <div class="form-group">\n' +
                        '                                    <div class="form-line">\n' +
                        '                                        <input class="form-control input" type="text" name="option_value[]"\n' +
                        '                                               placeholder="Option Value">\n' +
                        '                                    </div>\n' +
                        '                                </div>\n' +
                        '                            </div>\n' +
                        '                            <div class="col-md-5">\n' +
                        '                                <div class="form-group">\n' +
                        '                                    <div class="form-line">\n' +
                        '                                        <input class="form-control input" type="text" name="option_sequence[]"\n' +
                        '                                               placeholder="Sequence">\n' +
                        '                                    </div>\n' +
                        '                                </div>\n' +
                        '                            </div>\n' +
                        '                                <div class="col-md-2"><a href="javascrip: void(0)" class="remove_field"><i class="material-icons">delete_forever</i></a>\n' +
                        '                            </div>\n' +
                        '                        </div>'); //add input field
                }
            });
            $('.input_fields_container').on("click", ".remove_field", function (e) { //user click on remove text links
                e.preventDefault();
                $(this).parent('div').parent('div').remove();
                x--;
            })
        });
    </script>


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