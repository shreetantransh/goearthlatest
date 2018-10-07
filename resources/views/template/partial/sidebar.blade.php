<div class="header-sidebar">
    <ul>
        <li>
            <a href="">
                <img src="{{ asset('images/icons/track_order.svg') }}"/>
                <span>Track Order</span>
            </a>
        </li>
        <li>
            @customer
                <a href="{{ route('customer.dashboard') }}">
                    <img src="{{ asset('images/icons/user_login.svg') }}"/>
                    <span>My Account</span>
                </a>
            @else
                <a data-fancybox data-type="ajax" data-src="{{ route('customer.auth.account') }}"
                   href="javascript:;">
                    <img src="{{ asset('images/icons/user_login.svg') }}"/>
                    <span>My Account</span>
                </a>
            @endcustomer
        </li>
        <li>
            @customer
                <a href="{{ route('customer.wishlist.index') }}">
                    <img src="{{ asset('images/icons/wishlist.svg') }}"/>
                    <span>My Favourites</span>
                </a>
            @else
                <a data-fancybox data-type="ajax" data-src="{{ route('customer.auth.account') }}"
                   href="javascript:;">
                    <img src="{{ asset('images/icons/wishlist.svg') }}"/>
                    <span>My Favourites</span>
                </a>
            @endcustomer
        </li>
        <li>
            <a data-fancybox data-type="ajax" data-src="{{ route('customer.cart.items') }}">
                <img src="{{ asset('images/icons/cart.svg') }}"/>
                <span>Cart</span>
                <span id="items-in-cart-count">{{ $_cart->itemsCount() }}</span>
            </a>
        </li>
    </ul>
</div>

