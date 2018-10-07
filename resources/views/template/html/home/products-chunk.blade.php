<div class="vegetables {{ $method }} owl-carousel">
@foreach ($productCollection as $product_chunk)
    <div class="item">
        @foreach($product_chunk as $product)
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="box">
                    <div class="image">
                        <a href="{!! route('product.index', [isset($category->slug) ? $category->slug : optional($product->categories()->first())->slug, $product->getUrl()]) !!}"><img src="{{ $product->getBaseImage(\App\Models\ProductImage::VERY_SMALL) }}" alt="image" title="image" class="img-responsive" /></a>

                    </div>
                    <div class="caption">
                        <h4><a href="{!! route('product.index', [isset($category->slug) ? $category->slug : optional($product->categories()->first())->slug , $product->getUrl()]) !!}">{{ $product->getName() }}</a></h4>
                        <p>Fruits</p>
                        <div class="button-group icon-container">
                            <button data-product-id="{{ $product->id }}" type="button" id="wish-list-item"><i class="icon_heart"></i></button>
                            <button type="button"><i class="fa fa-expand"></i></button>
                            <button type="button" onclick="javascript: void(0);"  id="submitCart">
                                <i class="fa fa-shopping-cart"></i>
                            </button>
                            <form id="cart-form" >
                                <input type="hidden" name="product_id" value="{{ $product->id }}" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endforeach
</div>

<script>
    $('.{{ $method }}').owlCarousel({
        items: 2,
        itemsDesktop : [1199, 2],
        itemsDesktopSmall : [979, 1],
        itemsTablet : [768, 1],
        itemsMobile : [479, 1],
        navigation : true,
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem : false,
        navigationText: ['<i class="fa fa-long-arrow-left fa1"></i>', '<i class="fa fa-long-arrow-right fa2"></i>'],
        pagination: false,
    });
</script>

