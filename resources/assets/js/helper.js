export const CUSTOMER_LOGIN_POPUP_URL = APP_URL + '/customer/auth/account';
export const CUSTOMER_CART_POPUP_URL = APP_URL + '/customer/cart/get-cart';

export const showAuthForm = (options = {}) => {

    jQuery.fancybox.open({
        type: 'ajax',
        src: `${CUSTOMER_LOGIN_POPUP_URL}?${serialize(options)}`
    });
}

export const serialize = function (obj) {
    var str = [];
    for (var p in obj)
        if (obj.hasOwnProperty(p)) {
            str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
        }
    return str.join("&");
}

export const showCart = () => {

    jQuery.fancybox.open({
        type: 'ajax',
        src: `${CUSTOMER_CART_POPUP_URL}`
    });
}

export const hidePopup = () =>
{
    jQuery.fancybox.close();
}