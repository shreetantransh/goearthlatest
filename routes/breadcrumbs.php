<?php

// Home
Breadcrumbs::register('category', function ($breadcrumbs, $category) {
    $breadcrumbs->push('Home', url('/'));
    $breadcrumbs->push($category->name, '');
});

Breadcrumbs::register('product', function () {

});
