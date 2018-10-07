import axios from 'axios';
import jQuery from 'jquery';
import loader from './Loader';
import {showCart} from "../helper";
import {hidePopup} from "../helper";


const PRODUCT_ADD_TO_CART_URL = APP_URL + '/customer/cart/add-product';
const CART_UPDATE_URL = '/customer/cart/update';
const CART_ITEM_DELETE_URL = '/customer/cart/delete-item';
const GET_CHECKOUT_CART = '/customer/cart/get-checkout-cart';

class Cart {

    constructor() {

        this.cartForm = jQuery('form#cart-form');
        this.itemsInCartCount = jQuery('#items-in-cart-count');

        this.cartForm.on('submit', this._addItemToCart);

        this.lock = false;

        this._initQtyUpdaters();

        this._deleteItemFromCart();

        this._submitCart();

        this._addItemsToCart();

    }

    _initQtyUpdaters = () => {

        let context = this;

        jQuery('body').on('click', '#qty_updater', function () {

            var currentCartItemInstance = jQuery(this).closest('.product-row');
            var currentValue = parseInt(currentCartItemInstance.find('#product_qty').val());

            if (jQuery(this).hasClass('minus')) {

                if (currentValue > 1) {
                    currentCartItemInstance.find('#product_qty').val(currentValue - 1);
                    context._updateCart(currentCartItemInstance.closest('form'));
                }

            } else {
                currentCartItemInstance.find('#product_qty').val(currentValue + 1);
                context._updateCart(currentCartItemInstance.closest('form'));
            }

            Cart._getCheckoutCart();

        });
    }

    _deleteItemFromCart = () => {

        let context = this;

        jQuery('body').on('click', '#itemDelete', function () {

            var productId = jQuery(this).attr('data-content');

            context._deleteCart(productId);

        });


    }

    _deleteCart = (productId) => {

        if(this.lock)
            return false;

        loader.show();

        this.lock = true;

        var data = 'product_id=' + productId;

        axios.post(CART_ITEM_DELETE_URL, data, {accept: 'application/json'}).then(({data}) => {

            this.lock = false;

            jQuery(".cart-popup").html(data);

            loader.hide();

        }).catch(err => {

        });

        Cart._getCheckoutCart();

    }

    _addItemToCart = (e) => {

        e.preventDefault();

        if (this.lock) {
            return;
        }

        loader.show();

        this.lock = true;

        const form = jQuery(e.target);
        const options = form.serialize();

        axios.post(PRODUCT_ADD_TO_CART_URL, options, {accept: 'application/json'}).then(({data}) => {

            this.lock = false;
            loader.hide();

            this.itemsInCartCount.html(data.itemsCount);

            showCart();
            //showLenses(data.cartItem);

        }).catch(err => {
            this.lock = false;
            loader.hide();
        });
    }

    _updateCart = (form) => {

        var data = form.serialize();

        if (this.lock) {
            return;
        }

        this.lock = true;
        loader.show();

        axios.post(CART_UPDATE_URL, data, {accept: 'application/json'}).then(({data}) => {

            this.lock = false;

            jQuery('.cart-popup').html(data);

            loader.hide();

        }).catch(error => {

            this.lock = false;
            loader.hide();
        });
    }

   static _getCheckoutCart = (message = '') =>
    {

        var data = 'message=' + message;

        if(this.lock)
            return false;

        this.lock = true

        loader.show();

        axios.post(GET_CHECKOUT_CART, data, {accept: 'application/json'}).then(({data}) => {

            this.lock = false;

            jQuery("#checkoutCart").html(data);

            loader.hide();

        }).catch(error => {

            this.lock = false;

            loader.hide();
        });
    }

    _submitCart = () =>
    {
        jQuery('body').on('click', 'a#submitCart', function () {
           jQuery(this).closest(".product-buttons").find("form#cart-form").submit();
           return false;
        });
    }

    _addItemsToCart = () =>
    {
       jQuery("body").on('submit', 'form#cart-form', this._addItemToCart);
    }
}

new Cart();

export default Cart;

window.Cart = Cart;