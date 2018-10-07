import jQuery from 'jquery';
import loader from './Loader';
import FormError from './FormError'

import 'bootstrap4-datetimepicker';

const AUTH_REGISTER_URL = APP_URL + '/customer/auth/register';
const AUTH_LOGIN_URL = APP_URL + '/customer/auth/login';

const AUTH_EMAIL_AVAILABILITY = APP_URL + '/customer/auth/email-availability';
const AUTH_MOBILE_AVAILABILITY = APP_URL + '/customer/auth/mobile-availability';

const PASSWORD_MIN_LENGTH = 5;

class CustomerAuth {

    constructor() {

        this.regsiterForm = jQuery('form#register-form');
        this.loginForm = jQuery('form#login-form');


        this.registerFormErrorHandler = new FormError(this.regsiterForm);
        this.loginFormErrorHandler = new FormError(this.loginForm);

        this._initComponents();
        this._setRegisterValidationRules();
        this._setLoginValidationRules();

        this._showAccounts();
    }

    _initComponents() {
        this.regsiterForm.find('#dob').datetimepicker({
            //debug: true,
            format: 'DD/MM/YYYY'
        });
    }

    _setRegisterValidationRules = () => {

        this.regsiterForm.validate({
            focusCleanup: true,
            rules: {
                first_name: 'required',
                last_name: 'required',
                mobile: {
                    required: true,
                    remote: {
                        url: AUTH_MOBILE_AVAILABILITY,
                        message: 'The mobile is already been taken'
                    }
                },
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: AUTH_EMAIL_AVAILABILITY,
                    }
                },
                password: {
                    required: true,
                    minlength: PASSWORD_MIN_LENGTH
                },
                gender: 'required'
            },
            messages: {
                mobile: {
                    remote: jQuery.validator.format("{0} is already been taken.")
                },
                email: {
                    remote: jQuery.validator.format("{0} is already been taken.")
                }
            },
            submitHandler: this._handleOnRegister
        });
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

    _handleOnRegister = (form) => {

        var data = jQuery(form).serialize();

        loader.show();

        axios.post(AUTH_REGISTER_URL, data, {dataType: 'json', accept: 'application/json'}).then((res) => {

            loader.hide();

            if (res.data.hasOwnProperty('redirectUrl')) {
                window.location.href = res.data.redirectUrl;
            }

        }).catch(({request}) => {
            loader.hide();

            const {status, response} = request;

            if (status === 422 || status === 423) {
                this.registerFormErrorHandler.show(JSON.parse(response));
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

    _showAccounts = () =>
    {
        jQuery('body').on('click', "#register_button", function () {
            jQuery("#login-form-container").fadeOut();
            jQuery("#registration-form-container").fadeIn();
        });

        jQuery('body').on('click', "#already_register", function () {
            jQuery("#registration-form-container").fadeOut();
            jQuery("#login-form-container").fadeIn();
        });


    }
}

window.CustomerAuth = CustomerAuth;




