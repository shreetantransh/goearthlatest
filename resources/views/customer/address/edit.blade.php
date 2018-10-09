@extends('customer.layout')

@section('tab-content')

    <div class="addresses">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="custome-heading">add new address</h2>

                @if(!$address->id)
                    {!! Form::open(['method' => 'post', 'class' => 'customer-form', 'route' => 'customer.address.store']) !!}
                @else
                    {!! Form::model($address, ['route' => ['customer.address.update', $address->id], 'class' => 'customer-form', 'method' => 'PUT']) !!}
                @endif

                <div class="row">
                    <div class="col col-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="first name" class="control-label">first name</label>
                            {!! Form::text('first_name', null, ['class' => ('form-control' . ($errors->has('first_name') ? ' is-invalid' : '')), 'id' => 'first_name']) !!}
                            {!! $errors->first('first_name', '<p class="invalid-feedback">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col col-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="last name" class="control-label">last name</label>
                            {!! Form::text('last_name', null, ['class' => ('form-control' . ($errors->has('last_name') ? ' is-invalid' : '')), 'id' => 'last_name']) !!}
                            {!! $errors->first('last_name', '<p class="invalid-feedback">:message</p>') !!}
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 ">
                        <div class="form-group check-group-checkout">
                            <label for="Gender" class="control-label">Gender</label>
                            <div class="check-row">
                                <div class="form-check-gender">
                                    <label class="form-check-label">
                                        <input type="radio" name="gender" value="1">Male
                                    </label>
                                </div>
                                <div class="form-check-gender">
                                    <label class="form-check-label">
                                        <input type="radio" name="gender" value="1">Female
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col col-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="number" class="control-label">mobile number</label>
                            {!! Form::text('mobile', null, ['class' => ('form-control' . ($errors->has('mobile') ? ' is-invalid' : '')), 'id' => 'mobile']) !!}
                            {!! $errors->first('mobile', '<p class="invalid-feedback">:message</p>') !!}
                        </div>
                    </div>

                    <div class="col col-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="email" class="control-label">email address</label>
                            {!! Form::text('email', null, ['class' => ('form-control' . ($errors->has('email') ? ' is-invalid' : '')), 'id' => 'email']) !!}
                            {!! $errors->first('email', '<p class="invalid-feedback">:message</p>') !!}
                        </div>
                    </div>


                    <div class="col col-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="number" class="control-label">address</label>
                            {!! Form::text('address', null, ['class' => ('form-control' . ($errors->has('address') ? ' is-invalid' : '')), 'id' => 'address']) !!}
                            {!! $errors->first('address', '<p class="invalid-feedback">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col col-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="email" class="control-label">street</label>
                            {!! Form::text('street', null, ['class' => ('form-control' . ($errors->has('street') ? ' is-invalid' : '')), 'id' => 'street']) !!}
                            {!! $errors->first('street', '<p class="invalid-feedback">:message</p>') !!}
                        </div>
                    </div>

                    <div class="col col-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="state" class="control-label">state/province</label>
                            {!! Form::select('state', array_merge(['' => 'Select State'], $states), old('city', $address->state_id), ['class' => 'form-control', 'id' => 'state']) !!}
                            {!! $errors->first('state', '<p class="invalid-feedback">:message</p>') !!}
                        </div>
                    </div>

                    <div class="col col-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="email" class="control-label">city/district</label>
                            {!! Form::select('city', array_merge(['' => 'Select City'], $cities), old('city', $address->city_id), ['class' => 'form-control', 'id' => 'city']) !!}
                            {!! $errors->first('city', '<p class="invalid-feedback">:message</p>') !!}
                        </div>
                    </div>

                    <div class="col col-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="number" class="control-label">landmark</label>
                            {!! Form::text('landmark', null, ['class' => ('form-control' . ($errors->has('landmark') ? ' is-invalid' : '')), 'id' => 'landmark']) !!}
                            {!! $errors->first('landmark', '<p class="invalid-feedback">:message</p>') !!}
                        </div>
                    </div>


                    <!--
                    <div class="col col-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="coutry" class="control-label">country</label>
                            <select class="form-control" id="country" name="country">
                                <option value="" selected="selected">Please Select</option>
                                <option value="India">India</option>
                                <option value="India">India</option>
                                <option value="India">India</option>
                            </select>
                        </div>
                    </div>
                    -->

                    <div class="col col-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="number" class="control-label">zip/pin code</label>
                            {!! Form::text('pincode', null, ['class' => ('form-control' . ($errors->has('pincode') ? ' is-invalid' : '')), 'id' => 'pincode']) !!}
                            {!! $errors->first('pincode', '<p class="invalid-feedback">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col col-12 col-md-6 col-sm-12">
                        <div class="form-check form-check-inline">

                            {!! Form::checkbox('default', true, $address->is_default); !!}
                            <label class="form-check-label" for="default" >  Save as default address</label>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                    <div class="col col-12 ">
                        <div class="form-footer">
                            <button type="submit" class="btn-submit">save & continue</button>
                        </div>
                    </div>
                    <br>

                </div>

                <div class="row">

                </div>

                {{ Form::close() }}
            </div>
        </div>

    </div>
@endsection