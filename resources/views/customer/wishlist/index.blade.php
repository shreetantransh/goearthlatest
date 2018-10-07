@extends('customer.layout')

@section('tab-content')

    <div class="wishlist">

        <h2>My Favourites</h2>

        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-12">

                @if($wishlist->count())
                    @foreach($wishlist as $product)
                        <div class="wishlist-content">
                            <div class="row">
                                <div class="col col-auto">
                                    <img src="{{ $product->getBaseImage(\App\Models\ProductImage::IMAGE_SMALL) }}"
                                         alt="{{ $product->getName() }}" class="img-fluid" />
                                </div>
                                <div class="col">
                                    <h4>{{ $product->getName() }}</h4>
                                    <div class="favourite-price">
                                        @include('catalog.product.partial.price')
                                    </div>
                                </div>
                                <div class="col col-lg-2 d-flex flex-1 justify-content-end flex-column">
                                    <div class="wishlist-footer">
                                        <div class="shop-cart">
                                            <a href="" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                                                <i class="fa fa-shopping-cart" aria-hidden="true" ></i>
                                            </a>
                                        </div>
                                        <div class="heart">
                                            <a href="" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {!! $wishlist->links() !!}

                @else
                    <div class="no-items">
                        <h4>No items</h4>
                        <p>You haven't added any item in your favourites yet.</p>
                        <a class="btn btn-primary" href='{{ url('/') }}'>Show Now</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection