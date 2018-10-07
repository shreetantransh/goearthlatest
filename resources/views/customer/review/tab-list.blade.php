@if( $product->reviews->count() )

    <h2>({{ $product->reviews->count() }}) Review for {{ $product->getName() }}</h2>

    <div class="row">
        @foreach($product->reviews as $review)
            <div class="col-sm-12">
                <div class="image">
                    <img src="{{ asset('go-earth/images/review-img.png') }}" alt="user" title="user" class="img-responsive"/>
                </div>
                <div class="detail">
                    <h5>{{ $review->title }}</h5>
                    <p>{{ $review->description }}</p>
                    <div class="star">
                        <div class="">
                            {{ $review->rating }} <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <h5 style="padding: 50px 0">Be first to review this product

            @customer
            <a href="{{ route('customer.review.create', $product->getUrl()) }}"
               class="btn btn-primary mb-2">Write a review</a>
            @else
                <a data-fancybox data-type="ajax" data-src="{{ route('customer.auth.account') }}" href="javascript:;"
                   class="btn btn-primary mb-2">Write a review</a>
                @endcustomer
        </h5>

    </div>
@endif



