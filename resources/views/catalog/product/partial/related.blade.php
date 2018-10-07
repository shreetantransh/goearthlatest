
@if($relatedProducts->count())


<div class="products-block related-products">
    <div class="block-title">
        <h2 class="title">Related <span>Products</span></h2>
    </div>

    <div class="block-content">
        <div class="products owl-theme owl-carousel">
            @foreach ($relatedProducts as $product)
                @include('catalog.category.partial.product')>
                @endforeach
        </div>
    </div>
</div>
@endif
