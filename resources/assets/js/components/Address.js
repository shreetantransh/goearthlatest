import axios from 'axios';
import jQuery from 'jquery';
import loader from './Loader';

const GET_CITIES_URL = "/get-cities";


class Address{

    constructor()
    {
        this._getCitiesByState();

        this._deleteAddress();
    }

    _getCitiesByState = () =>
    {
        let context = this;

        jQuery("select#state").on('change', function () {

            var stateId = jQuery(this).val();

            if(stateId)
            {
                context._setCitiesByState(stateId);
            }

        });

    }

    _setCitiesByState = (stateId) =>
    {
        var data = 'state=' + stateId;

        if(this.lock)
            return false;

        loader.show();

        axios.post(GET_CITIES_URL, data, {accept: 'application/json'}).then(({data}) =>
        {
            this.lock = false;

            loader.hide();

            jQuery("select#city").html('').append(data.options);

        }).catch(err => {
            this.lock = false;
            loader.hide();
        });

    }

    _deleteAddress = (e) =>
    {
        jQuery("#addressDelete").on('click', function () {

           jQuery(this).closest(".address-footer").find('form').submit();

        });
    }

}

new Address();