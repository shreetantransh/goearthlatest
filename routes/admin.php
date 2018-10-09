<?php

Route::group(['prefix' => 'auth', 'as' => 'auth.', 'namespace' => 'Auth'], function () {

    Route::get('login', 'LoginController@showForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout')->name('logout');

});

Route::group(['middleware' => 'auth:admin'], function () {

    Route::get('dashboard', 'DashboardController')->name('dashboard');
    Route::get('account/setting', 'Account\SettingController')->name('setting');
    Route::put('account/setting', 'Account\SettingController@update')->name('setting.update');

    Route::group(['prefix' => 'catalog', 'as' => 'catalog.', 'namespace' => 'Catalog'], function () {

        Route::group(['prefix' => 'attributes', 'as' => 'attributes.', 'namespace' => 'Attributes'], function () {

            Route::resource('attribute-set', 'AttributeSetController');
            Route::resource('attribute', 'AttributeController');
            Route::resource('attribute-group', 'AttributeGroupController');
            Route::resource('manage-attribute', 'AttributeManageController');

        });

        Route::group(['prefix' => 'product', 'as' => 'product.', 'namespace' => 'Products'], function () {

            Route::get('/', 'GridController')->name('grid');

            Route::get('create', 'CreateController@showForm')->name('create');
            Route::post('create', 'CreateController@save');

//            Route::get('create', 'CreateController@showForm')->name('create');
//            Route::get('create', 'CreateController@save')->name('store');

            Route::group(['prefix' => '{product}/edit/tab', 'as' => 'tab.'], function () {

                Route::get('product', 'EditController@showForm')->name('product');
                Route::post('product', 'EditController@save');

                Route::get('related', 'RelatedController@showForm')->name('related');
                Route::post('related', 'RelatedController@save');

                Route::get('up-sells', 'UpsellController@showForm')->name('up-sell');
                Route::post('up-sells', 'UpsellController@save');

                Route::get('cross-sells', 'CrossSellController@showForm')->name('cross-sell');
                Route::post('cross-sells', 'CrossSellController@save');

                Route::get('configurable-product', 'ConfigurableController@showForm')->name('configurable');
                Route::post('configurable-product', 'ConfigurableController@save');
            });

            Route::post('upload-image/{product}', 'EditController@uploadImage')->name('image_upload');
        });

        Route::group(['prefix' => 'category', 'as' => 'category.', 'namespace' => 'Category'], function () {

            Route::get('/', 'GridController')->name('grid');

            Route::get('/create', 'CreateController@create')->name('create');
            Route::post('/create', 'CreateController@store');

            Route::get('/edit/{category}', 'EditController@edit')->name('edit');
            Route::post('/edit/{category}', 'EditController@update')->name('update');

            Route::delete('/delete/category/{category}', 'DeleteController')->name('delete');
        });

    });

    Route::group(['prefix' => 'cms/page', 'as' => 'cms.page.', 'namespace' => 'CMS\Page'], function () {

        Route::get('/', 'GridController')->name('grid');

        Route::get('/create', 'CreateController@create')->name('create');
        Route::post('/create', 'CreateController@store');

        Route::get('/edit/{page}', 'EditController@edit')->name('edit')->where('page', '[0-9]+');
        Route::post('/edit/{page}', 'EditController@update')->name('update')->where('page', '[0-9]+');

        Route::delete('/delete/category/{page}', 'DeleteController')->name('delete');
    });

    Route::group(['prefix' => 'banner', 'as' => 'banner.', 'namespace' => 'Banner'], function () {
        Route::get('/', 'IndexController')->name('all');
        Route::get('/', 'IndexController')->name('all');

        Route::get('/create', 'CreateController')->name('create');
        Route::post('/store', 'CreateController@Store')->name('store');

        Route::get('/{banner}/edit', 'EditController')->name('edit');
        Route::put('update/{banner}', 'EditController@update')->name('update');

        Route::delete('delete/{banner}', 'EditController@destroy')->name('delete');
    });

    Route::group(['prefix' => 'voucher', 'as' => 'voucher.', 'namespace' => 'Voucher'], function () {
        Route::get('/', 'IndexController')->name('all');

        Route::get('/create', 'CreateController')->name('create');
        Route::post('/store', 'CreateController@Store')->name('store');

        Route::get('/{voucher}/edit', 'EditController')->name('edit');
        Route::put('update/{voucher}', 'EditController@update')->name('update');

        Route::delete('delete/{voucher}', 'EditController@destroy')->name('delete');
    });

    Route::group(['prefix' => 'customer', 'as' => 'customer.', 'namespace' => 'Customer'], function () {
        Route::get('/', 'IndexController')->name('all');
        Route::get('/{customer}', 'ViewController')->name('view');
    });

    Route::group(['prefix' => 'order', 'namespace' => 'Order', 'as' => 'order.'], function (){
        Route::get('/', 'GridController')->name('all');
        Route::get('{order}/view', 'ViewController')->name('view');
        Route::post('{order}/view', 'InvoiceController@updateStatus')->name('update.status');
        Route::get('invoice/{order}', 'InvoiceController')->name('invoice');
    });

    Route::resource('testimonial', 'TestimonialController');
});