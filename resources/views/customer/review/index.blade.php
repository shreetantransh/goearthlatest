@extends('customer.layout')

@section('tab-content')

    <div class="reviews">
        <h2>my reviews <span>( {{ $reviews->total() }} )</span></h2>

        <div class="row">
            <div class="col col-12">

                @if($reviews->count())

                    @foreach($reviews as $review)
                        @php
                            $class = '';

                            if ($review->rating >= 4) {
                                $class = 'review-star-green';
                            }
                            else if ($review->rating >= 2) {
                                $class = 'review-star-orange';
                            } else {
                                $class = 'review-star-red';
                            }
                        @endphp
                        <div class="customer-review">
                            <div class="star">
                                <div class="{{ $class }}">
                                    {{ $review->rating }} <i class="fa fa-star" aria-hidden="true"></i>
                                </div>
                                @if($review->title)
                                <p>{{ $review->title }}</p>
                                    @endif
                            </div>
                            @if($review->description)
                            <div class="review-text">
                                <p>{!! $review->description !!}</p>
                            </div>
                            @endif
                            <p class="review-date">
                                <span class="customer-name"> {{ $review->customer->getFullName() }}</span>
                                <span class="text-review">{{ $review->created_at->format("F j Y") }}</span>
                            </p>
                        </div>
                    @endforeach
                    {!! $reviews->links() !!}
                @else
                    <h1 class="center">Reviews</h1>
                    <p class="center">You have not give review to any product yet.</p>
                @endif

            </div>

        </div>
    </div>

@endsection