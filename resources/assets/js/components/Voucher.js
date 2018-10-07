import axios from 'axios';
import jQuery from 'jquery';
import loader from './Loader';
import FormError from './FormError';

class Voucher
{
    constructor()
    {
        this.voucherForm = jQuery('form#voucher-form');

        this.voucherFormErrorHandler = new FormError(this.voucherForm);

        this._applyVoucher();
    }

    _applyVoucher = () =>
    {
        var context = this;

        jQuery('body').on('submit', 'form#voucher-form', function () {

            var form = jQuery(this);

            if (this.lock) {
                return;
            }

            this.lock = true;
            loader.show();

            form.find('label.error').remove();

            var data = new FormData(this);

            var url = jQuery(this).attr('action');

            axios.post(url, data, {dataType: 'json', accept: 'application/json'}).then(({data}) => {

                this.lock = false;

                loader.hide();

                Cart._getCheckoutCart(data.message);

            }).catch(({request}) => {

                this.lock = false;

                loader.hide();

                const {status, response} = request;

                if (status === 422 || status === 423) {
                    context.voucherFormErrorHandler.show(JSON.parse(response));

                }
            });

            return false;
        });
    }
}

new Voucher();