import axios from 'axios';
import jQuery from 'jquery';
import loader from './Loader'
import FormError from './FormError'

const AUTH_LOGIN_URL = APP_URL + '/checkout/login';
const PASSWORD_MIN_LENGTH = 5;

class Checkout {

    constructor() {

        this.loginForm = jQuery('form#login-form');
        this.loginFormErrorHandler = new FormError(this.loginForm) ;

        this._setLoginValidationRules();

        this._checkoutProcess();

        this._checkoutLoadForm();
    }


    _setLoginValidationRules = () => {
        this.loginForm.validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: PASSWORD_MIN_LENGTH
                }
            },
            submitHandler: this._handleOnLogin
        });
    }

    _handleOnLogin = (form) => {

        var data = jQuery(form).serialize();
        loader.show();

        this.loginFormErrorHandler.reset();

        axios.post(AUTH_LOGIN_URL, data, {dataType: 'json', accept: 'application/json'}).then(res => {

            loader.hide();
            this._handleResponse(res.data);

        }).catch(({request}) => {

            loader.hide();

            const {status, response} = request;

            if (status === 422 || status === 423) {
                this.loginFormErrorHandler.show(JSON.parse(response));
            }
        });
    }

    _handleResponse = (data) => {

        if (data.hasOwnProperty('responseHandler')) {

            switch (data.responseHandler) {
                case 'reloadSelf': {
                    window.location.reload();
                    break;
                }
                default: {
                    if (data.hasOwnProperty('redirectUrl')) {
                        window.location.href = data.redirectUrl;
                    }
                }
            }
        }
    }

    _checkoutProcess = () => {
        jQuery("body").on('change', "input#checkout_process", function () {
            var thisValue = jQuery(this).val();

            jQuery("div#checkout_process_input").toggleClass("checkout_process");

        });
    }

    _checkoutLoadForm = () => {
        jQuery("body").on('click', '#addNewAddress, #viewAddress', function () {
            jQuery("div#customerAddresses").toggleClass("checkout_process");
        });
    }

}

new Checkout();
