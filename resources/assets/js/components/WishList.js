import jQuery from 'jquery';
import loader from './Loader';
import {showAuthForm} from './../helper';

const WISH_LIST_ADD_URL = APP_URL + '/customer/favourites/add/';
const WISH_LIST_REMOVE_URL = APP_URL + '/customer/favourites/remove/';

class WishList {

    constructor() {

        let self = this;

        this.lock = false;

        jQuery('body').on('click', '#wish-list-item', function (e) {

            if (jQuery(this).hasClass('in-wishlist')) {
                self._removeToWishList(e, jQuery(this));
            } else {
                self._addToWishList(e, jQuery(this));
            }
        });
    }

    _removeToWishList = (e, element) => {

        if (this.lock) {
            return;
        }

        loader.show();
        element.removeClass('in-wishlist');

        const productId = element.attr('data-product-id');

        axios.post(WISH_LIST_REMOVE_URL + productId, {}, {dateType: 'json'}).then(res => {
            loader.hide();
            this.lock = false;
        }).catch(err => {
            loader.hide();
            element.addClass('in-wishlist');
            this.lock = false;
        });
    }

    _addToWishList = (e, element) => {

        if (this.lock) {
            return;
        }

        element.addClass('in-wishlist');

        const productId = element.attr('data-product-id');

        this.lock = true;

        loader.show();

        axios.post(WISH_LIST_ADD_URL + productId, {}, {dateType: 'json'}).then(res => {
            this.lock = false;
            loader.hide();
        }).catch(({request: {status}}) => {
            loader.hide();
            element.removeClass('in-wishlist');

            this.lock = false;

            if (status === 401) {
                showAuthForm({
                    responseHandler: 'reloadSelf',
                });
            }
        });
    }
}

new WishList();


