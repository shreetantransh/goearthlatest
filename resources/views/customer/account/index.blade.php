@extends('customer.layout')

@section('tab-content')

<div class="account">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h2 class="custome-heading">Account Information</h2>
            

            {!! Form::model($customer, ['class' => 'customer-form']) !!}

            <div class="row">
                <div class="col col-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label" for="first name">First Name</label>
                        {!! Form::text('first_name', null, ['class' => ('form-control' . ($errors->has('first_name') ? ' is-invalid' : '')), 'id' => 'first_name']) !!}
                        {!! $errors->first('first_name', '<p class="invalid-feedback">:message</p>') !!}
                    </div>
                </div>
                <div class="col col-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label" for="last name">Last Name</label>
                        {!! Form::text('last_name', null, ['class' => ('form-control' . ($errors->has('last_name') ? ' is-invalid' : '')), 'id' => 'last_name']) !!}
                        {!! $errors->first('last_name', '<p class="invalid-feedback">:message</p>') !!}
                    </div>
                </div>

                <div class="col col-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label" for="email">Email Address</label>
                        {!! Form::email('email', $customer->email, ['class' => 'form-control', 'id' => 'email', 'disabled' => true]) !!}
                    </div>
                </div>
                <div class="col col-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label" for="mobile">Contact Number</label>
                        {!! Form::text('mobile', null, ['class' => ('form-control' . ($errors->has('mobile') ? ' is-invalid' : '')), 'id' => 'mobile']) !!}
                        {!! $errors->first('mobile', '<p class="invalid-feedback">:message</p>') !!}
                    </div>
                </div>

                <div class="col col-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="gender" class="control-label">Gender</label>
                        {!! Form::select('gender',  $customer->getGenders()->prepend('Select:', ''), null, ['class' => ('form-control' . ($errors->has('gender') ? ' is-invalid' : '')), 'id' => 'gender'] ) !!}
                        {!! $errors->first('gender', '<p class="invalid-feedback">:message</p>') !!}
                    </div>
                </div>

                <div class="col col-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="gender" class="control-label">Date of birth</label>
                        {!! Form::text('dob',  null, ['class' => ('form-control' . ($errors->has('gender') ? ' is-invalid' : '')), 'id' => 'dob', 'autocomplete' => 'off', 'id' => 'datepicker'] ) !!}
                        {!! $errors->first('dob', '<p class="invalid-feedback">:message</p>') !!}
                    </div>
                </div>
            </div>

            <div class="margin-t10">
                {!! Form::checkbox('change_password', 1, old('change_password'), ['class' => 'form-check-input', 'id' => 'change_password']) !!}
                <label class="form-check-label " for="change_password">
                    Change Password
                </label>
            </div>

            <div id="password-box" class="{{ old('change_password') ? 'd-block' : 'd-none' }}">
                <div class="row">
                    <div class="col col-4 col-md-2 col-sm-12">
                        <div class="form-group">
                            <label class="control-label" for="current_password">Current Password</label>
                             {!! Form::password('current_password', ['class' => ('form-control' . ($errors->has('current_password') ? ' is-invalid' : '')), 'id' => 'current_password']) !!}
                            {!! $errors->first('current_password', '<p class="invalid-feedback">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col col-4 col-md-2 col-sm-12">
                        <div class="form-group">
                            <label class="control-label" for="password">New Password</label>
                            {!! Form::password('password', ['class' => ('form-control' . ($errors->has('password') ? ' is-invalid' : '')), 'id' => 'password']) !!}
                            {!! $errors->first('password', '<p class="invalid-feedback">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col col-4 col-md-2 col-sm-12">
                        <div class="form-group">
                            <label class="control-label" for="password_confirmation">Confirm Password</label>
                            {!! Form::password('password_confirmation', ['class' => ('form-control' . ($errors->has('password_confirmation') ? ' is-invalid' : '')), 'id' => 'password_confirmation']) !!}
                            {!! $errors->first('password_confirmation', '<p class="invalid-feedback">:message</p>') !!}
                        </div>
                    </div>
                                                                            
                </div>
            </div>
            <div class="row margin-t20">
                <div class="col-md- col-lg-12 col-sm-12 col-12">
                    <div class="form-footer">
                        <button type="submit" class="btn-submit">Update</button>
                    </div>
                </div>
            </div>
            <br>
            <div class="clearfix"></div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
