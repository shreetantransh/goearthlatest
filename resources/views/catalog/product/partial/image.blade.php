<div class="product-image">
    <a href="{!! route('product.index', [isset($category->slug) ? $category->slug : optional($product->categories()->first())->slug, $product->getUrl()]) !!}">
        <img src="{{ $product->getBaseImage(\App\Models\ProductImage::IMAGE_THUMBNAIL) }}" class="img img-responsive" alt="Product Image">
    </a>
</div>