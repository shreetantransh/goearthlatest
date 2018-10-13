@extends('template.1column')
@section('content')

    <div id="content" class="site-content">

        <div id="breadcrumb" style="padding: 80px 0 25px 0; background: url('img/bg-breadcrumb.jpg')">
            <div class="container">
                <h2 class="title">Contact Us</h2>
            </div>
        </div>

        <div class="container">
            <div class="contact-page">
                <div class="contact-info">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="item d-flex">
                                <div class="item-left">
                                    <div class="icon"><i class="zmdi zmdi-email"></i></div>
                                </div>
                                <div class="item-right d-flex">
                                    <div class="title">Email:</div>
                                    <div class="content">
                                        <a href="mailto:support@domain.com">support@domain.com</a><br>
                                        <a href="mailto:contact@domain.com">contact@domain.com</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="item d-flex justify-content-center">
                                <div class="item-left">
                                    <div class="icon"><i class="zmdi zmdi-home"></i></div>
                                </div>
                                <div class="item-right d-flex">
                                    <div class="title">Address:</div>
                                    <div class="content">
                                        23 Suspendis matti, Visaosang Building VST<br> District, NY Accums, North
                                        American
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="item d-flex justify-content-end">
                                <div class="item-left">
                                    <div class="icon"><i class="zmdi zmdi-phone"></i></div>
                                </div>
                                <div class="item-right d-flex">
                                    <div class="title">Holine:</div>
                                    <div class="content">
                                        0123-456-78910<br>
                                        0987-654-32100
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="contact-map">
                    <div id="map"></div>
                    <div class="hidden-lg hidden-md hidden-sm hidden-xs contact-address">815 Sunset Boulevard Ca 70079
                    </div>
                </div>

                <div class="contact-intro">
                    <p>“Proin gravida nibh vel velit auctor aliquet. Aenean sollicudin, lorem quis bibendum auctor, nisi
                        elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vultate cursus
                        a sit amet mauris. Proin gravida nibh vel velit auctor”</p>
                    <img src="img/contact-icon.png" alt="Contact Comment">
                </div>

                <div class="contact-form form">
                    <form action="index.html" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input type="text" name="name" placeholder="YOUR NAME">
                            </div>

                            <div class="col-md-6">
                                <input type="email" name="email" placeholder="YOUR EMAIL">
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="text" name="subject" placeholder="SUBJECT">
                        </div>

                        <div class="form-group">
                            <textarea rows="10" name="content" placeholder="MESSAGE"></textarea>
                        </div>

                        <div class="form-group text-center">
                            <input type="submit" class="btn btn-primary" value="Send Message">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <style>
        .home-4 .intro .intro-header p {
            max-width: 1001px;
        }

        .intro {
            height: auto;
        }
    </style>

@endsection
