@extends('admin.layout.edit')

@section('title')
    <div class="block-header">
        <h2>ACCOUNT DETAILS</h2>
    </div>
@endsection

@section('form')


        {!! Form::model($setting, ['method' => 'put', 'files' => true, 'route' => ['admin.setting.update', $setting->id]]) !!}

    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="header">
                    <h2>GENERAL SETTING</h2>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::materialText('First Name', 'first_name', old('first_name', $setting->first_name), $errors->first('first_name')) !!}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::materialText('Last Name', 'last_name', old('last_name', $setting->last_name), $errors->first('last_name')) !!}
                            </div>
                        </div>

                        <div class="clarfix"></div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::materialText('Email', 'email', old('email', $setting->email), $errors->first('email')) !!}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::materialText('Username', 'username', old('username', $setting->username), $errors->first('username')) !!}
                            </div>
                        </div>

                        <div class="clarfix"></div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::materialText('Contact Number', 'contact_number', old('contact_number', $setting->contact_number), $errors->first('contact_number')) !!}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::materialText('Contact Number Other', 'contact_number_other', old('contact_number_other', $setting->contact_number_other), $errors->first('contact_number_other')) !!}
                            </div>
                        </div>

                        <div class="clarfix"></div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::materialText('Facebook', 'facebook', old('facebook', $setting->facebook), $errors->first('facebook')) !!}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::materialText('Twitter', 'twitter', old('twitter', $setting->twitter), $errors->first('twitter')) !!}
                            </div>
                        </div>

                        <div class="clarfix"></div>


                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::materialText('Google', 'google', old('google', $setting->google), $errors->first('google')) !!}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::materialText('Youtube', 'youtube', old('youtube', $setting->youtube), $errors->first('youtube')) !!}
                            </div>
                        </div>
                        <div class="clarfix">&nbsp;</div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::materialText('Linked In', 'linked_in', old('linked_in', $setting->linked_in), $errors->first('linked_in')) !!}
                            </div>
                        </div>

                        <div class="clarfix">&nbsp;</div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                {!! Form::materialTextArea('Address', 'address', old('address', $setting->address), $errors->first('address')) !!}
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                {!! Form::materialTextArea('Address Othter', 'address_other', old('address_other', $setting->address_other), $errors->first('address_other')) !!}
                            </div>
                        </div>

                        <div class="clarfix"></div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::materialFile('Logo Image', 'image', $errors->first('image')) !!}
                                @if($setting->image)
                                    <br>
                                    <img src="{{ $setting->getLogo() }}" style="height: 50px">
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::materialFile('Footer Logo Image', 'footer_logo', $errors->first('footer_logo')) !!}
                                @if($setting->image)
                                    <br>
                                    <img src="{{ $setting->getFooterLogo() }}" style="height: 50px">
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
                    <button id="save" type="submit" class="btn btn-primary btn-lg waves-effect">SAVE</button>
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

    {!! Form::open(['route' => ['admin.banner.delete', $setting->id], 'method' => 'delete', 'id' => 'delete']) !!}
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