
            <div class="product-base-image"  id="product-base-image">
            <img data-zoom-image="{{ $product->getBaseImage( \App\Models\ProductImage::IMAGE_ZOOM ) }}"
                 class="img-fluid product-image img-responsive"
                 alt="{{ $product->getName() }}"
                 src="{{ $product->getBaseImage( \App\Models\ProductImage::IMAGE_FULL ) }}"
            />
            </div>


        @if($product->images()->count())

            <ul class="thumbnails list-inline" id="product-image-nav">
                @foreach($product->images as $productImage)
                    <li  class="image-additional">
                        <a class="thumbnail product-image"  href="#" data-image="{{ $productImage->getUrl( \App\Models\ProductImage::IMAGE_FULL ) }}" data-zoom-image="{{ $productImage->getUrl( \App\Models\ProductImage::IMAGE_ZOOM ) }}">
                            <img src="{{ $productImage->getUrl( \App\Models\ProductImage::IMAGE_SMALL ) }}"/>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif

