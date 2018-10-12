@extends('template.1column')
@section('content')



    <div id="content" class="site-content">

        <div id="breadcrumb" style="padding: 80px 0 25px 0; background: url('{{ asset('img/bg-breadcrumb.jpg') }}')">
            <div class="container">
                <h2 class="title">Search</h2>

            </div>
        </div>

        <div class="container">
            <div class="row">
                <div id="center-column" class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <div class="product-category-page">



                        <div class="tab-content">
                            <!-- Products Grid -->
                            <div class="tab-pane active" id="products-grid">
                                <div class="products-block">

                                    @if($productCollection->count())

                                            @foreach($productCollection as $product)
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            @include('catalog.category.partial.product')
                                                </div>
                                        @endforeach

                                            {{ $productCollection->links() }}
                                    @else
                                        <h4>!Oops, Product not found.</h4>
                                    @endif

                                </div>
                            </div>
                        </div>





                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
