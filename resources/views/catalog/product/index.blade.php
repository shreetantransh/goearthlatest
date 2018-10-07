@extends('template.2column-left')
@section('content')

    <div id="content" class="site-content">

        @if($category->hasImage())
            <div id="breadcrumb" style="padding: 80px 0 25px 0; background: url('{{ $category->hasImage() ? url($category->getBannerImage(1950, 200)) : '' }}')">
                <div class="container">
                    <h2 class="title">{{ $category->getName() }}</h2>
                    {{ Breadcrumbs::render('category', $category) }}
                    {{ $product->getName() }}
                </div>
            </div>
        @endif

            <div class="container">
                <div class="row">
                    <!-- Sidebar -->
                    <div id="left-column" class="sidebar col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <!-- Block - Product Categories -->
                        @if($categories->count())
                            <div class="block product-categories">
                                <h3 class="block-title">Categories</h3>

                                <div class="block-content">
                                    @foreach($categories as $_category)
                                        <div class="item">
                                            <a class="category-title" href="{{ $_category->getUrl() }}">{{ $_category->getName() }}</a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                    @endif


                        <!-- Block - Products -->
                        <div class="block products-block layout-5">
                            <h3 class="block-title">Best Seller</h3>

                            <div class="block-content">
                                <div class="product-item">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-12 col-xs-12 product-left">
                                            <div class="product-image">
                                                <a href="product-detail-left-sidebar.html">
                                                    <img class="img-responsive" src="img/product/4.jpg" alt="Product Image">
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-md-8 col-sm-12 col-xs-12 product-right">
                                            <div class="product-info">
                                                <div class="product-title">
                                                    <a href="product-detail-left-sidebar.html">
                                                        Organic Strawberry Fruits
                                                    </a>
                                                </div>

                                                <div class="product-rating">
                                                    <div class="star on"></div>
                                                    <div class="star on"></div>
                                                    <div class="star on"></div>
                                                    <div class="star on"></div>
                                                    <div class="star"></div>
                                                    <span class="review-count">(3 Reviews)</span>
                                                </div>

                                                <div class="product-price">
                                                    <span class="sale-price">$45.00</span>
                                                    <span class="base-price">$38.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="product-item">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-12 col-xs-12 product-left">
                                            <div class="product-image">
                                                <a href="product-detail-left-sidebar.html">
                                                    <img class="img-responsive" src="img/product/30.jpg" alt="Product Image">
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-md-8 col-sm-12 col-xs-12 product-right">
                                            <div class="product-info">
                                                <div class="product-title">
                                                    <a href="product-detail-left-sidebar.html">
                                                        Organic Strawberry Fruits
                                                    </a>
                                                </div>

                                                <div class="product-rating">
                                                    <div class="star on"></div>
                                                    <div class="star on"></div>
                                                    <div class="star on"></div>
                                                    <div class="star on"></div>
                                                    <div class="star on"></div>
                                                    <span class="review-count">(3 Reviews)</span>
                                                </div>

                                                <div class="product-price">
                                                    <span class="sale-price">$75.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="product-item">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-12 col-xs-12 product-left">
                                            <div class="product-image">
                                                <a href="product-detail-left-sidebar.html">
                                                    <img class="img-responsive" src="img/product/24.jpg" alt="Product Image">
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-md-8 col-sm-12 col-xs-12 product-right">
                                            <div class="product-info">
                                                <div class="product-title">
                                                    <a href="product-detail-left-sidebar.html">
                                                        Organic Strawberry Fruits
                                                    </a>
                                                </div>

                                                <div class="product-rating">
                                                    <div class="star on"></div>
                                                    <div class="star on"></div>
                                                    <div class="star on"></div>
                                                    <div class="star on"></div>
                                                    <div class="star"></div>
                                                    <span class="review-count">(3 Reviews)</span>
                                                </div>

                                                <div class="product-price">
                                                    <span class="sale-price">$80.00</span>
                                                    <span class="base-price">$90.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Page Content -->
                    <div id="center-column" class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <div class="product-detail">
                            <div class="products-block layout-5">
                                <div class="product-item">
                                    <div class="product-title">
                                        {{ ucwords($product->getName()) }}
                                    </div>

                                    <div class="row">
                                        <div class="product-left col-md-5 col-sm-5 col-xs-12">
                                            <div class="product-image horizontal">
                                                @include('catalog.product.partial.media')
                                            </div>
                                        </div>

                                        <div class="product-right col-md-7 col-sm-7 col-xs-12">
                                            <div class="product-info">
                                                @include('catalog.product.partial.price')

                                                <div class="product-stock">
                                                    <span class="availability">Availability :</span><i class="fa fa-check-square-o" aria-hidden="true"></i>In stock
                                                </div>

                                                @include('catalog.product.partial.description')



                                                <div class="product-share border-bottom">
                                                    <div class="item">
                                                        <a href="#"><i class="zmdi zmdi-share" aria-hidden="true"></i><span class="text">Share</span></a>
                                                    </div>
                                                    <div class="item">
                                                        <a href="#"><i class="zmdi zmdi-email" aria-hidden="true"></i><span class="text">Send to a friend</span></a>
                                                    </div>
                                                    <div class="item">
                                                        <a href="#"><i class="zmdi zmdi-print" aria-hidden="true"></i><span class="text">Print</span></a>
                                                    </div>
                                                </div>

                                                <div class="product-review border-bottom">
                                                    <div class="item">
                                                        <div class="product-quantity">
                                                            <span class="control-label">Review :</span>
                                                            @include('catalog.product.partial.rating')
                                                        </div>
                                                    </div>

                                                    <div class="item">
                                                        <a href="#"><i class="zmdi zmdi-comments" aria-hidden="true"></i><span class="text">Read Reviews (3)</span></a>
                                                    </div>

                                                    <div class="item">
                                                        <a href="#"><i class="zmdi zmdi-edit" aria-hidden="true"></i><span class="text">Write a review</span></a>
                                                    </div>
                                                </div>

                                                <div class="product-extra">
                                                    <div class="item">
                                                        <span class="control-label">Review :</span><span class="control-label">E-02154</span>
                                                    </div>
                                                    <div class="item">
                                                        <span class="control-label">Categories :</span>
                                                        <a href="{{ $category->getUrl() }}" title="Vegetables">{{ $category->getName() }}</a>

                                                    </div>

                                                    <br>

                                                    @include('catalog.product.partial.buttons')
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @include('catalog.product.partial.tabs')
                                </div>
                            </div>
                        </div>

                        <!-- Related Products -->

                    </div>
                </div>
            </div>


    </div>


@endsection


