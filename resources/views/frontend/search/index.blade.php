@extends('template.2column-left')
@section('content')
    <div class="category-image">
        <img class="img-fluid" src="{{ asset('images/trending/search.jpeg') }}"/>
    </div>
    <div class="container" id="category-main">

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12 col-sm-12">
                @if($productCollection->count())
                    <div class="row d-flex flex-1 align-content-between category-product-grid">
                        @include('catalog.category.partial.list')

                        {{ $productCollection->links() }}
                    </div>
                @else
                    <h4>!Oops, Product not found.</h4>
                @endif
            </div>
        </div>
    </div>
@endsection
