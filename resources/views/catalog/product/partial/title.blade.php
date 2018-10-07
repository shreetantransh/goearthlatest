<div class="product-title">
    <a href="{!! route('product.index', [isset($category->slug) ? $category->slug : optional($product->categories()->first())->slug, $product->getUrl()]) !!}">
        {{ $product->getName() }}
    </a>
</div>