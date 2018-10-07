@extends('template.2column-left')
@section('content')

    <div id="content" class="site-content">

        @if($category->hasImage())
            <div id="breadcrumb"
                 style="padding: 80px 0 25px 0; background: url('{{ $category->hasImage() ? url($category->getBannerImage(1950, 200)) : '' }}')">
                <div class="container">
                    <h2 class="title">{{ $category->getName() }}</h2>
                    {{ Breadcrumbs::render('category', $category) }}
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


                <!-- Block - Filter -->
                    <div class="block product-filter">
                        <h3 class="block-title">Catalog</h3>

                        <div class="block-content">

                            <div class="filter-item">
                                <h3 class="filter-title">By Price</h3>

                                <div class="block-content">
                                    <div id="slider-range" class="tiva-filter">
                                        <div class="filter-item price-filter">
                                            <div class="layout-slider">
                                                <input id="price-filter" name="price" value="0;100"/>
                                            </div>
                                            <div class="layout-slider-settings"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div id="center-column" class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <div class="product-category-page">
                        <!-- Nav Bar -->
                        <div class="products-bar">
                            <div class="row">
                                <div class="col-md-6 col-xs-6">
                                    <div class="gridlist-toggle" role="tablist">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#products-grid" data-toggle="tab"
                                                                  aria-expanded="true"><i
                                                            class="fa fa-th-large"></i></a></li>
                                            <li><a href="#products-list" data-toggle="tab" aria-expanded="false"><i
                                                            class="fa fa-bars"></i></a></li>
                                        </ul>
                                    </div>

                                    <div class="total-products">There are 12 products</div>
                                </div>

                                <div class="col-md-6 col-xs-6">
                                    <div class="filter-bar">
                                        <form action="#" class="pull-right">
                                            <div class="select">
                                                <select class="form-control">
                                                    <option value="">Sort By</option>
                                                    <option value="1">Price: Lowest first</option>
                                                    <option value="2">Price: Highest first</option>
                                                    <option value="3">Product Name: A to Z</option>
                                                    <option value="4">Product Name: Z to A</option>
                                                    <option value="5">In stock</option>
                                                </select>
                                            </div>
                                        </form>
                                        <form action="#" class="pull-right">
                                            <div class="select">
                                                <select class="form-control">
                                                    <option value="">Relevance</option>
                                                    <option value="1">Price: Lowest first</option>
                                                    <option value="2">Price: Highest first</option>
                                                    <option value="3">Product Name: A to Z</option>
                                                    <option value="4">Product Name: Z to A</option>
                                                    <option value="5">In stock</option>
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content">
                            <!-- Products Grid -->
                            <div class="tab-pane active" id="products-grid">
                                <div class="products-block">
                                    <div class="row" id="catalog-product-grid">

                                    </div>
                                </div>
                            </div>

                            <!-- Products List -->
                            <div class="tab-pane" id="products-list">
                                <div class="products-block layout-5" id="catalog-product-list">

                                </div>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>

    </div>
@endsection
