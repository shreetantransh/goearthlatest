@extends('template.1column')

@section('content')

    <!-- Main Content -->
    <div id="content" class="site-content">

@if($banners->count())
            <!-- Slideshow -->
        <div class="section slideshow">
            <div class="container">
                <div class="tiva-slideshow-wrapper">
                    <div id="tiva-slideshow" class="nivoSlider">
                        @foreach ($banners as $banner)
                        <a href="#">
                            <img class="img-responsive" src="{{ $banner->getImage(1920, 500) }}" alt="Slideshow Image">
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
@endif

<!-- Payment Intro -->
    <div class="section payment-intro">
        <div class="container">
            <div class="payment-wrap">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="item d-flex">
                            <div class="item-left">
                                <img src="img/icon/Layer-12.png" alt="Payment Intro">
                            </div>
                            <div class="item-right">
                                <h3 class="title">Free Shipping item</h3>
                                <div class="content">Proin gravida nibh vel velit auctor aliquet. Aenean lorem quis bibendum auctor</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="item d-flex">
                            <div class="item-left">
                                <img src="img/icon/Layer-13.png" alt="Payment Intro">
                            </div>
                            <div class="item-right">
                                <h3 class="title">Secured Payment</h3>
                                <div class="content">Proin gravida nibh vel velit auctor aliquet. Aenean lorem quis bibendum auctor</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="item d-flex">
                            <div class="item-left">
                                <img src="img/icon/Layer-14.png" alt="Payment Intro">
                            </div>
                            <div class="item-right">
                                <h3 class="title">Money Back Guarantee</h3>
                                <div class="content">Proin gravida nibh vel velit auctor aliquet. Aenean lorem quis bibendum auctor</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="item d-flex">
                            <div class="item-left">
                                <img src="img/icon/ten-lua.png" alt="Payment Intro">
                            </div>
                            <div class="item-right">
                                <h3 class="title">Express Shipping</h3>
                                <div class="content">Proin gravida nibh vel velit auctor aliquet. Aenean lorem quis bibendum auctor</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Product - Our Products -->
    <div class="section products-block product-tab tab-2">
        <div class="block-title">
            <div class="sub-title">Fresh From Our Farm</div>
            <h2 class="title">Our <span>Products</span></h2>
        </div>

        <div class="block-content">
            <div class="container">
                <!-- Tab Navigation -->
                <div class="tab-nav" id="home_links">

                    @if($categories->count())

                    <ul>
                        @foreach($categories as $key => $category)
                        <li data-toggle="tab" class="{{ $key == 0 ? 'active' : '' }}">
                            <a data-toggle="tab" href="#{{ $category->slug }}" id="home-category-anchor"  data-content="{{ $category->slug }}">
                                <img src="img/product/product-category-0.png" alt="{{ $category->slug }}">
                                <span>{{ $category->getName() }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>

                        @endif
                </div>

                <!-- Tab Content -->
                <div class="tab-content">
                    <!-- All Products -->
                    <div role="tabpanel" class="" id="home-category-container">

                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- Intro -->
    <div class="section intro">
        <div class="block-content">
            <div class="container">
                <div class="intro-wrap">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 text-center">
                            <div class="intro-header">
                                <h3>Why Choose Us</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis nostrud</p>
                            </div>
                            <div class="intro-social">
                                <ul>
                                    <li><a href="#"><img src="img/icon/img-face.png" alt="Social Item"></a></li>
                                    <li><a href="#"><img src="img/icon/img-in.png" alt="Social Item"></a></li>
                                    <li><a href="#"><img src="img/icon/img-insta.png" alt="Social Item"></a></li>
                                    <li><a href="#"><img src="img/icon/img-p.png" alt="Social Item"></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 top-left text-center">
                            <div class="intro-item">
                                <p><img src="img/icon/leaves.png" alt="Intro Image"></p>
                                <h4>Always Fresh</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 top-right text-center">
                            <div class="intro-item">
                                <p><img src="img/icon/tree.png" alt="Intro Image"></p>
                                <h4>100% Natural</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 bottom-left text-center">
                            <div class="intro-item">
                                <p><img src="img/icon/heath.png" alt="Intro Image"></p>
                                <h4>Super Healthy</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 bottom-right text-center">
                            <div class="intro-item">
                                <p><img src="img/icon/hc.png" alt="Intro Image"></p>
                                <h4>Premium Quality</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    </div>
@endsection


