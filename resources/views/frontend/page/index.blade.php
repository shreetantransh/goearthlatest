@extends('template.2column-left')
@section('content')

    @push('header-script')
        <title>{!! $page->meta_title !!}</title>
        <meta name="description" content="{!! strip_tags($page->meta_description) !!}">
        <meta name="keywords" content="{!! strip_tags($page->meta_keywords) !!}">
    @endpush

    <!-- bread-crumb start here -->
    <div class="bread-crumb">
        <img src="{{ asset('go-earth/images/top-banner.png') }}" class="img-responsive" alt="banner-top" title="banner-top">
        <div class="container">
            <div class="matter">
                <h2><span>{{ $page->getName() }}</span></h2>
            </div>
        </div>
    </div>
    <!-- bread-crumb end here -->

    <!-- organic start here -->
    <div class="organic">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12 commontop text-center">
                    <h4>
                        <i class="icon_star_alt"></i>
                        <i class="icon_star_alt"></i>
                        <i class="icon_star_alt"></i>
                        {{ $page->getName() }}
                        <i class="icon_star_alt"></i>
                        <i class="icon_star_alt"></i>
                        <i class="icon_star_alt"></i>
                    </h4>

                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                   {!! $page->content !!}
                </div>

            </div>
        </div>
    </div>
    <!-- organic end here -->

@endsection
