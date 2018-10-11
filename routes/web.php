<?php

Route::group(['prefix' => 'customer', 'as' => 'customer.', 'namespace' => 'Customer'], function () {

    Route::group(['namespace' => 'Auth', 'as' => 'auth.', 'prefix' => 'auth'], function () {

        Route::get('account', 'LoginController@showForm')->name('account');

        Route::post('register', 'RegisterController@register');
        Route::post('login', 'LoginController@login');

        Route::get('email-availability', 'RegisterController@emailAvailability');
        Route::get('mobile-availability', 'RegisterController@mobileAvailability');
    });

    Route::group(['prefix' => 'cart', 'as' => 'cart.'], function () {
        Route::get('get-cart', 'CartController@getCart')->name('items');
        Route::post('add-product', 'CartController@addProduct')->name('items.add');
        Route::get('cart-info', 'CartController@getCartInfo');
        Route::post('update', 'CartController@update');
        Route::post('delete-item', 'CartController@deleteItem');
    });


    Route::group(['middleware' => 'auth:customer'], function () {

        Route::get('logout', 'Auth\LoginController@logout')->name('auth.logout');

        Route::get('dashboard', 'DashboardController')->name('dashboard');
        Route::get('account', 'AccountController@index')->name('account.index');
        Route::post('account', 'AccountController@update');

        Route::resource('address', 'AddressController');

        Route::group(['prefix' => 'review', 'as' => 'review.'], function () {

            Route::get('/', 'ReviewController@index')->name('index');
            Route::get('/{product}/new', 'ReviewController@create')->name('create');
            Route::post('/{product}/new', 'ReviewController@store');
        });

        Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
            Route::get('/', 'OrderController@index')->name('index');
            Route::get('/detail', 'OrderController@detail')->name('detail');
        });

        Route::group(['prefix' => 'favourites', 'as' => 'wishlist.'], function () {
            Route::get('/', 'WishListController@index')->name('index');
            Route::post('add/{product}', 'WishListController@addItem')->name('wishlist.add')->where('product', '[0-9]+');
            Route::post('remove/{product}', 'WishListController@removeItem')->name('wishlist.remove')->where('product', '[0-9]+');
        });
    });
});

Route::group(['namespace' => 'Frontend'], function () {

    Route::get('/', 'HomeController')->name('home');

    //checkout routes
    Route::group(['prefix' => 'checkout', 'as' => 'checkout.'], function () {
        //route for cart when user click on cart icon in header
        Route::get('cart', 'Checkout\CheckoutController@getCart')->name('cart');
        Route::get('get-checkout', 'Checkout\CheckoutController@getCheckout')->name('get-checkout');
        Route::post('saveAddress', 'Checkout\CheckoutController@postAddress')->name('saveAddress');
        Route::post('save_guest_details', 'Checkout\CheckoutController@postSaveGuest')->name('save_guest_details');
        Route::post('updateCart', 'Checkout\CheckoutController@updateCart')->name('updateCart');
        Route::get('deleteCartItem/{product_id}', 'Checkout\CheckoutController@deleteCartItem')->name('deleteCartItem');
        Route::post('postCheckout', 'Checkout\CheckoutController@postCheckout')->name('postCheckout');
        Route::get('thank-you', 'Checkout\CheckoutController@getThankyou')->name('thank-you');
        Route::get('post-ccavenue', 'Checkout\CheckoutController@postCCAvenue')->name('post-ccavenue');
        Route::get('response-ccavenue', 'Checkout\CheckoutController@getResponseCCAvenue')->name('response-ccavenue');
    });



    Route::group(['prefix' => 'product', 'namespace' => 'Products', 'as' => 'product.'], function () {
        Route::get('/', 'IndexController')->name('index');
        Route::get('/{slug}', 'DetailController')->name('detail');
    });

    Route::group(['namespace' => 'Subscribe'], function (){
        Route::post('subscribe', 'IndexController@index')->name('subscribe');
        Route::get('un-subscribe/{email}', 'IndexController@unSubscribe')->name('un-subscribe');
        Route::get('resubscribe/{email}', 'IndexController@reSubscribe')->name('resubscribe');
        Route::get('subscriber/success', 'IndexController@success')->name('un-subscribe.success');
    });

    Route::get("search", 'Search\IndexController')->name('search');
    Route::get("cms/{slug}", 'Cms\IndexController')->name('page');

    Route::get('/home-products/{type}', 'HomeController@homeCategoryProducts')->name('home.category.products');


    Route::get('{category}/{product}', 'Product\IndexController')->name('product.index')->where([
        'product' => '[a-z0-9\-]+'
    ]);

    Route::get('{category}', 'Category\IndexController')->name('category');


});


Route::group(['namespace' => 'Master', 'as' => '.master'], function () {

    Route::group(['namespace' => 'Address'], function () {
        Route::post('get-cities', 'CityController@getCities')->name('states');
    });


});



