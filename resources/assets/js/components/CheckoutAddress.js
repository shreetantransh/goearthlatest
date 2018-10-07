import axios from 'axios';
import jQuery from 'jquery';
import loader from './Loader';
import FormError from './FormError';
import Cart from './Cart';

const SOTRE_ADDRES_URL = '/checkout/address/store';
const CUSTOMER_ADDRES_URL = '/checkout/address/get';

class CheckoutAddress
{
    constructor()
    {
        this.addressForm = jQuery("form#address-form");
        this.addressFormErrorHandler = new FormError(this.addressForm);

        this.custoemrAddressForm = jQuery("form#customer-address-form");
        this.customerAddressFormErrorHandler = new FormError(this.custoemrAddressForm);

        this._setAddressValidationRoules();
        this._setCustomerAddressValidationRoules();
    }

    _setAddressValidationRoules = () =>
    {
        this.addressForm.validate({
            focusCleanup: true,
            rules: {
                first_name: 'required',
                last_name: 'required',
                mobile_number: 'required',
                email: {
                    required: true,
                    email: true
                },
                address: 'required',
                state: 'required',
                city: 'required'
            },
            submitHandler: this._handleOnStoreAddress
        });
    }

    _handleOnStoreAddress = (form) =>
    {

        if (this.lock) {
            return;
        }

        this.lock = true;

        loader.show();

        var data = jQuery(form).serialize();

        this.addressFormErrorHandler.reset();

        axios.post(SOTRE_ADDRES_URL, data, {accept: 'application/json'}).then(({data}) => {

            this.lock = false;

            loader.hide();

            jQuery("#checkout-container").html(data);

            //this._handleResponse(res.data);

        }).catch(({request}) => {

            this.lock = false;

            loader.hide();

            const {status, response} = request;

            if (status === 422 || status === 423) {
                this.addressFormErrorHandler.show(JSON.parse(response));
            }
        });
    }

    _setCustomerAddressValidationRoules = () =>
    {
        this.custoemrAddressForm.validate({
            focusCleanup: true,
            rules: {
                customer_address: 'required',
            },
            submitHandler: this._handleOnGetAddress
        });
    }

    _handleOnGetAddress = (form) =>
    {

        if (this.lock) {
            return;
        }

        this.lock = true;

        loader.show();

        var data = jQuery(form).serialize();

        this.customerAddressFormErrorHandler.reset();

        axios.post(CUSTOMER_ADDRES_URL, data, {accept: 'application/json'}).then(({data}) => {

            this.lock = false;

            loader.hide();

            jQuery("#checkout-container").html(data);

            //this._handleResponse(res.data);

        }).catch(({request}) => {

            this.lock = false;

            loader.hide();

            const {status, response} = request;

            if (status === 422 || status === 423) {
                this.customerAddressFormErrorHandler.show(JSON.parse(response));
            }
        });
    }
}

new CheckoutAddress();