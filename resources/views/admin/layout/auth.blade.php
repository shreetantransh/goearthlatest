<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>{{ config('app.name') }}</title>

    <META NAME="ROBOTS" CONTENT="NOINDEX, FOLLOW">
    <META NAME="ROBOTS" CONTENT="INDEX, NOFOLLOW">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">

    <!-- Favicon-->
    <link rel="icon" href="{{ url('/favicon.ico') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ url('admin/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ url('admin/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ url('admin/plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ url('admin/css/style.css') }}" rel="stylesheet">
</head>

<body class="login-page">
<div class="login-box">
    <div class="logo">
        <a href="javascript:void(0);">{{ config('app.name')}}</a>
        <small>Administrator Panel</small>
    </div>
    <div class="card">
        <div class="body">
            @yield('card-body')
        </div>
    </div>
</div>

<!-- Jquery Core Js -->
<script src="{{ url('admin/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap Core Js -->
<script src="{{ url('admin/plugins/bootstrap/js/bootstrap.js') }}"></script>

<!-- Waves Effect Plugin Js -->
<script src="{{ url('admin/plugins/node-waves/waves.js') }}"></script>

<!-- Validation Plugin Js -->
<script src="{{ url('admin/plugins/jquery-validation/jquery.validate.js') }}"></script>

<!-- Custom Js -->
<script src="{{ url('admin/js/admin.js') }}"></script>
<script src="{{ url('admin/js/pages/examples/sign-in.js') }}"></script>
</body>

</html>