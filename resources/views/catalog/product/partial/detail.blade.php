<h5><span>{{ $product->getName() }}</span></h5>
<div class="rating">
    <i class="fa fa-star"></i>
    <i class="fa fa-star"></i>
    <i class="fa fa-star"></i>
    <i class="fa fa-star"></i>
    <i class="fa fa-star"></i>
</div>
<p class="shortdes">
    {{ $product->getShortDescription() }}
</p>
<hr>
<h5>Product Features</h5>
<ul class="list-unstyled featured">
    <li><i class="icon_box-checked"></i> 100% Fresh not Chemicals</li>
    <li><i class="icon_box-checked"></i> 100% Organic food</li>
    <li><i class="icon_box-checked"></i> 100% Fresh Food from farm</li>
</ul>
<hr>
<div class="price">
    @include('catalog.product.partial.price')
</div>
<hr>
<div class="common">
    <p class="qtypara pull-left">
        <label class="control-label" for="input-quantity">Qty weight <span>(In kg)</span> : </label>
        <span id="minus2" class="minus"><i class="fa fa-minus"></i></span>
        <input type="text" name="quantity" value="1" size="2" id="input-quantity" class="form-control qty"/>
        <span id="add2" class="add"><i class="fa fa-plus"></i></span>
        <input type="hidden" name="product_id" value="1"/>
    </p>
    <div class="share pull-right">
        <label>Share:</label>
        <ul class="list-inline social">
            <li>
                <a href="https://www.facebook.com/" target="_blank">
                    <i class="social_facebook"></i>
                </a>
            </li>
            <li>
                <a href="https://twitter.com/" target="_blank">
                    <i class="social_twitter"></i>
                </a>
            </li>
            <li>
                <a href="https://plus.google.com/" target="_blank">
                    <i class="social_googleplus"></i>
                </a>
            </li>
            <li>
                <a href="https://in.pinterest.com/" target="_blank">
                    <i class="social_pinterest"></i>
                </a>
            </li>
            <li>
                <a href="https://www.instagram.com/" target="_blank">
                    <i class="social_instagram"></i>
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="buttons">
    <div class="buttons icon-container">

        <form id="cart-form">
            <input type="hidden" name="product_id" value="{{ $product->id }}" />
        </form>

        <button type="submit" class="btn btn-lg btn-primary" id="submitCart">
            <i class="fa fa-shopping-cart"></i>
            Add to Cart
        </button>
        <button type="button" class="btn-default"><i class="icon_heart"></i></button>
        <button type="button" class="btn-default"><i class="icon_piechart"></i></button>

    </div>


</div>


