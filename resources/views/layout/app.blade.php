<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=320, height=device-height"/>
    @stack('header-script')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css"/>

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('libs/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/font-material/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/nivo-slider/css/nivo-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/nivo-slider/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/nivo-slider/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/owl.carousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/slider-range/css/jslider.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/reponsive.css') }}">


    <script type="text/javascript">
        const APP_URL = "{{ url('/') }}";
        const APP_CURRENT_URL = "{{ url()->current() }}";
    </script>
</head>
<body class="home home-4">
<div id="all">


@include('template.partial.header')

    @yield('appContent')

@include('template.partial.footer')


<div id="loader" class="loader">
    <div class="loader-image"></div>
</div>

</div>

<script src="{{ asset('js/app.js') }}"></script>

<script src="{{ asset('libs/jquery.countdown/jquery.countdown.js') }}"></script>
<script src="{{ asset('libs/nivo-slider/js/jquery.nivo.slider.js') }}"></script>
<script src="{{ asset('libs/owl.carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('libs/slider-range/js/tmpl.js') }}"></script>
<script src="{{ asset('libs/slider-range/js/jquery.dependClass-0.1.js') }}"></script>
<script src="{{ asset('libs/slider-range/js/draggable-0.1.js') }}"></script>
<script src="{{ asset('libs/slider-range/js/jquery.slider.js') }}"></script>
<script src="{{ asset('libs/elevatezoom/jquery.elevatezoom.js') }}"></script>

<!-- Template CSS -->
<script src="{{ asset('js/main.js') }}"></script>


@stack('before_body_close')
</body>
</html>
