<header id="header">
    <div class="container">
        <div class="header-top">
            <div class="row align-items-center">
                <!-- Header Left -->

                <div class="col-lg-5 col-md-5 col-sm-12">
                    <!-- Main Menu -->
                    <div id="main-menu">
                        <ul class="menu">

                            <li class="dropdown item  has-sub">
                                <a href="product-grid-left-sidebar.html" title="Product">Category</a>
                                <div class="dropdown-menu">
                                    <ul>
                                        @foreach($categories as $category)
                                            <li class="has-image">
                                                <img src="img/product/product-category-5.png"
                                                     alt="Product Category Image">
                                                <a href="{{ $category->getUrl() }}"
                                                   title="Tea and coffee">{{ $category->getName() }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>

                            <li class="dropdown item  has-sub">
                                <a href="blog-list-left-sidebar-1.html">Blog</a>
                            </li>

                            <li class="item about">
                                <a href="page-about-us.html">About Us</a>
                            </li>

                            <li class="item contact">
                                <a href="page-contact.html">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Header Center -->
                <div class="col-lg-2 col-md-2 col-sm-12 header-center justify-content-center">
                    <!-- Logo -->
                    <div class="logo">
                        <a href="{{ url('/') }}">
                            <img class="img-responsive" src="{{ asset('img/logo.png') }}" alt="Logo">
                        </a>
                    </div>

                    <span id="toggle-mobile-menu"><i class="zmdi zmdi-menu"></i></span>
                </div>


                <!-- Header Right -->
                <div class="col-lg-5 col-md-5 col-sm-12 header-right d-flex justify-content-end align-items-center">
                    <!-- Search -->
                    <div class="form-search">
                        <form action="index.html" method="get">
                            <input type="text" class="form-input" placeholder="Search">
                            <button type="submit" class="fa fa-search"></button>
                        </form>
                    </div>

                    <!-- Cart -->
                    <div class="block-cart dropdown">
                        <div class="cart-title">
                            <a data-fancybox data-type="ajax" data-src="{{ route('customer.cart.items') }}">
                                <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                <span class="cart-count" id="items-in-cart-count">{{ $_cart->itemsCount() }}</span>
                            </a>
                        </div>
                    </div>


                    <!-- My Account -->
                    <div class="my-account dropdown toggle-icon">
                        <div class="dropdown-toggle" data-toggle="dropdown">
                            <i class="zmdi zmdi-menu"></i>
                        </div>
                        <div class="dropdown-menu">
                            <div class="item">
                                <a href="#" title="Log in to your customer account"><i class="fa fa-cog"></i>My Account</a>
                            </div>

                            @customer
                            <div class="item">
                                <a class="dropdown-item" id="has-sub-menu" href="javascript: void(0)"
                                   title="Account">{{ Auth::user('customer')->getFullName() }}</a>
                            </div>
                            @else

                                <div class="item">
                                    <a href="user-login.html" class="dropdown-item" data-fancybox data-type="ajax"
                                       data-src="{{ route('customer.auth.account') }}"
                                       href="javascript:;" title="Log in to your customer account"><i
                                                class="fa fa-sign-in"></i>Login</a>
                                </div>
                                @endcustomer



                                <div class="item">
                                    <a href="user-register.html" title="Register Account"><i class="fa fa-user"></i>Register</a>
                                </div>
                                <div class="item">
                                    <a href="#" title="My Wishlists"><i class="fa fa-heart"></i>My Wishlists</a>
                                </div>
                                <div class="item">
                                    <!-- Language -->
                                    <div class="language switcher">
                                        <a href="#" title="Language English" class="active"><img
                                                    src="img/language-en.jpg" alt="Language English"></a>
                                        <a href="#" title="Language French"><img src="img/language-fr.jpg"
                                                                                 alt="Language French"></a>
                                        <a href="#" title="Language Deutsch"><img src="img/language-de.jpg"
                                                                                  alt="Language Deutsch"></a>
                                    </div>

                                    <!-- Currency -->
                                    <div class="currency switcher">
                                        <a href="#" INR="USD" class="active">INR</a>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>