import axios from 'axios';
import jQuery from 'jquery';
import loader from './Loader';
import FormError from './FormError';

class Subscribe
{
    constructor()
    {

        this.subscribeForm = jQuery('#newsletter-form');

        this.subscribeFormErrorHandler = new FormError(this.subscribeForm);

        this._subscribeSubmit();

    }

    _subscribeSubmit = () =>
    {
        let context = this;

        jQuery('#newsletter-form').on('submit', function () {
            context._sendRequest(jQuery(this));
            return false;
        });
    }

    _sendRequest(form)
    {

        if(this.lock)
            return false;

        this.lock = true;

        loader.show();

        var context = this;

        const URL = form.attr('action');

        var data = form.serialize();

        axios.post(URL, data, {accept: 'application/json'}).then(({data}) => {

            this.lock = false;

            loader.hide();

            form.last().after('<div class="success">'+ data.message +'</div>');



        }).catch(({request}) => {

            this.lock = false;

            loader.hide();

            const {status, response} = request;

            if (status === 422 || status === 423) {
                context.subscribeFormErrorHandler.show(JSON.parse(response));

            }
        });

        return false;
    }


}

new Subscribe();