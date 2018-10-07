<div class="product-price">
    @if($product->hasSpecialPrice())
        <span class="sale-price">{!! $product->getFormattedPrice() !!}</span>
        <span class="base-price">{!! $product->getFormattedFinalPrice() !!}</span>
    @else
        <span class="base-price">{!! $product->getFormattedFinalPrice() !!}</span>
    @endif
</div>