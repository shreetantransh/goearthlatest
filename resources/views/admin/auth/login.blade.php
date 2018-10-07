@extends('admin.layout.auth')

@section('card-body')
    {!! Form::open(['novalidate' => 'novalidate', 'id' => 'sign_in']) !!}
    <div class="msg">Sign in to start your session</div>
    <div class="input-group">
        <span class="input-group-addon">
            <i class="material-icons">person</i>
        </span>
        <div class="form-line{{ $errors->has('username') ? ' error' : '' }}">
            {!! Form::text('username', old('username'), ['class' => 'form-control', 'placeholder' => 'Username', 'required', 'autofocus']) !!}
        </div>
        {!! $errors->first('username', '<label for="username" class="error">:message</label>') !!}
    </div>
    <div class="input-group">
        <span class="input-group-addon">
            <i class="material-icons">lock</i>
        </span>
        <div class="form-line">
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password', 'required']) !!}
        </div>
        {!! $errors->first('password', '<label for="password" class="error">:message</label>') !!}
    </div>
    <div class="row">
        <div class="col-xs-8 p-t-5">
            {!! Form::checkbox('remember', true, old('remember'), ['class' => 'filled-in chk-col-blue', 'id' => 'remember']) !!}
            {!! Form::label('remember', 'Remember Me') !!}
        </div>
        <div class="col-xs-4">
            {!! Form::submit('SIGN IN', ['class' => 'btn btn-block btn-primary waves-effect']) !!}
        </div>
    </div>
    <div class="row m-t-15 m-b--20">
        <div class="col-xs-6  col-xs-offset-3 align-center">
            {!! Html::link('#', 'Forgot Password?') !!}
        </div>
    </div>
    {!! Form::close() !!}
@endsection