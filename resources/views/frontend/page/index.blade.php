@extends('template.1column')
@section('content')

    @push('header-script')
        <title>{!! $page->meta_title !!}</title>
        <meta name="description" content="{!! strip_tags($page->meta_description) !!}">
        <meta name="keywords" content="{!! strip_tags($page->meta_keywords) !!}">
    @endpush

    <div id="content" class="site-content">

            <div id="breadcrumb" style="padding: 80px 0 25px 0; background: url('img/bg-breadcrumb.jpg')">
                <div class="container">
                    <h2 class="title">{{ $page->getName() }}</h2>
                </div>
            </div>




            <div class="container">
                <div class="about-us intro">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="intro-header">
                                    <h3>{{ $page->getName() }}</h3>
                                    <p>{!! $page->getContent() !!}</p>
                                </div>
                            </div>

                            @if($page->slug == 'about-us')

                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="intro-left">
                                    <div class="intro-item">
                                        <p><img src="img/intro-icon-1.png" alt="Intro Image"></p>
                                        <h4>Always Fresh</h4>
                                        <p>Unlike artificially preserved foods, organic food travels from farm to kitchen faster.</p>
                                    </div>

                                    <div class="intro-item">
                                        <p><img src="img/intro-icon-3.png" alt="Intro Image"></p>
                                        <h4>Super Healthy</h4>
                                        <p>Organic food comes with naturally more vitamins, minerals and omega-3s.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="effect">
                                    <a href="#">
                                        <img class="img-responsive" src="img/intro-1.png" alt="Intro Image">
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="intro-right">
                                    <div class="intro-item">
                                        <p><img src="img/intro-icon-2.png" alt="Intro Image"></p>
                                        <h4>100% Natural</h4>
                                        <p>No added artificial colors, flavors or preservatives.</p>
                                    </div>

                                    <div class="intro-item">
                                        <p><img src="img/intro-icon-4.png" alt="Intro Image"></p>
                                        <h4>Premium Quality</h4>
                                        <p>World-class quality with certifications from several national regulators.</p>
                                    </div>
                                </div>
                            </div>

                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>


    </div>

    <style>
        .home-4 .intro .intro-header p {
            max-width: 1001px;
        }

        .intro
        {
            height: auto;
        }
    </style>

@endsection
