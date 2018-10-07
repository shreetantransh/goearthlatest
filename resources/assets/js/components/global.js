import jQuery from 'jquery';

class global {

    constructor()
    {
        this._showDropdown();
    }


    _showDropdown = () => {
        jQuery("body").on('click', '#has-sub-menu', function (e) {
            e.stopPropagation();
            jQuery('body').find('.open').removeClass('open');
            jQuery(this).closest('li').addClass('open');
        });

        jQuery("body").on('click', function () {
            jQuery(this).find('.open').removeClass('open');
        });
    }
}

new global();