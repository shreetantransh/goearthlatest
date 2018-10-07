try {

    window.jQuery = window.$ = require('jquery');

    require('bootstrap');

    window.slick = require('slick-carousel');
    window.elevateZoom = require('@zeitiger/elevatezoom');
    window.axios = require('axios');

    window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    let token = document.head.querySelector('meta[name="csrf-token"]');

    if (token) {
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    } else {
        console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
    }

} catch (e) {
    console.log(e.message);
}



