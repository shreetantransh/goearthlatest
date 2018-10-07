@extends('template.1column')

@section('content')

    <div class="container-fluid">
        <div class="edit-review-section">
            <div class="row">
                <div class="col-12 col-md-6 col-sm-6 col-lg-auto">
                    <img src="{{ $product->getBaseImage( \App\Models\ProductImage::IMAGE_MEDIUM ) }}"
                         class="img-fluid"/>


                </div>
                <div class="col-md-6 col-sm-6 col-12 col-lg-5">
                    <h2>{{ $product->getName()  }}</h2>

                    @include('catalog.product.partial.price')

                    <div class="review-form">

                        {!! Form::open() !!}

                        <input type="hidden" value="{{ $product->id }}" name="product_id" />

                        <div class="form-group">
                            <div id="rating-star" data-rateyo-rating="{{ old('rating') }}"></div>
                            <input type="hidden" name="rating" id="rating" value="{{ old('rating') }}"/>
                        </div>

                        <div class="form-group">
                            {!! Form::label('title', 'Title (optional)') !!}
                            {!! Form::text('title', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('description', 'Description (optional)') !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3]) !!}
                        </div>

                        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection