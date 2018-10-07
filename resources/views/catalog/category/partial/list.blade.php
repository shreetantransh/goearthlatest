@foreach ($productCollection as $product)

    <div class="product-item">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                @include('catalog.product.partial.image')
            </div>

            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <div class="product-info">
                    @include('catalog.product.partial.title')

                    @include('catalog.product.partial.rating')

                    @include('catalog.product.partial.price')

                    <div class="product-stock">
                        <i class="fa fa-check-square-o" aria-hidden="true"></i>In stock
                    </div>

                    @include('catalog.product.partial.description')

                    @include('catalog.product.partial.buttons')
                </div>
            </div>
        </div>
    </div>

@endforeach