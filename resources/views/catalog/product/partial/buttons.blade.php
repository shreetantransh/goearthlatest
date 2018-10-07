<div class="product-buttons">
    <form id="cart-form" >
        <input type="hidden" name="product_id" value="{{ $product->id }}" />
    </form>
    <a class="add-to-cart"  onclick="javascript: void(0);"  id="submitCart">
        <i class="fa fa-shopping-basket" aria-hidden="true"></i>
    </a>

    <a class="add-wishlist" onclick="javascript: void(0);" data-product-id="{{ $product->id }}" id="wish-list-item">
        <i class="fa fa-heart" aria-hidden="true"></i>
    </a>

    <a class="quickview" href="#">
        <i class="fa fa-eye" aria-hidden="true"></i>
    </a>
</div>