@if($upSells->count())
    <div class="products-block related-products">
        <div class="block-title">
            <h2 class="title">Up <span>Sells</span></h2>
        </div>

        <div class="block-content">
            <div class="products owl-theme owl-carousel">
                @foreach ($upSells as $product)
                    @include('catalog.category.partial.product')
                @endforeach
            </div>
        </div>
    </div>
@endif

