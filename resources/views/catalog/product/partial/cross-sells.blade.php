@if($crossSells->count())
    <div class="products-block related-products">
        <div class="block-title">
            <h2 class="title">Cross <span>Sells</span></h2>
        </div>

        <div class="block-content">
            <div class="products owl-theme owl-carousel">
                @foreach ($crossSells as $product)
                    @include('catalog.category.partial.product')
                @endforeach
            </div>
        </div>
    </div>
@endif

