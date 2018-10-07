import axios from 'axios';
import jQuery from 'jquery';
import loader from './Loader';

const HOME_PRODUCT_URL = APP_URL +  '/home-products/';
const CACHE = {};

class Home
{

    constructor()
    {
        this.homeCategoryContainer = jQuery("#home-category-container");

        if(this.homeCategoryContainer.length < 1)
            return false;

        this.homeCategoryContainerType = jQuery("#home-category-anchor").attr('data-content');


        this._hometabProducts(this.homeCategoryContainerType);

        this._getTabProducts();

        this.bestSellerProdct = jQuery("#best-seller-container");

        if(this.bestSellerProdct.length < 1)
            return false;


        this.bestSeller = 'BestSeller';

        this._getProductBySeller(this.bestSeller);

        this.newProductContainer = jQuery("#new-product-container");

        if(this.newProductContainer.length < 1)
            return false;


        this.newProduct = 'NewProducts';

        this._getNewProducts(this.newProduct);


    }

    _hometabProducts = (productType) =>
    {
        if(productType in CACHE)
        {
            jQuery("div#home-category-container").html(CACHE[productType]);
            return false;
        }

        if(this.lock)
            return false;

        this.lock = true;

        loader.show();


        axios.get(HOME_PRODUCT_URL + productType, null, {accept: 'application/json'}).then(({data}) => {

            CACHE[productType] = data.view;

            this.lock = false;

            loader.hide();

            jQuery("#home-category-container").html(data.view);


        }).catch(error => {

            this.lock = false;
            loader.hide();

        });

    }

    _getTabProducts = () =>
    {
        let context = this;

        jQuery("a#home-category-anchor").on('click', function () {

            this.homeCategoryContainer  = jQuery(this).attr('data-content');

            context._hometabProducts(this.homeCategoryContainer);

            return false;
        });

    }

    _getProductBySeller = (type) =>
    {
        if(type in CACHE)
        {
            jQuery(this.bestSellerProdct).html(CACHE[type]);
            return false;
        }

        if(this.lockCategory)
            return false;

        this.lockCategory = true;

        loader.show();


        axios.get(HOME_PRODUCT_URL + type, null, {accept: 'application/json'}).then(({data}) => {

            CACHE[type] = data.view;

            this.lockCategory = false;

            loader.hide();

            jQuery(this.bestSellerProdct).html(data.view);


        }).catch(error => {

            this.lockCategory = false;
            loader.hide();
        });
    }

    _getNewProducts = (type) =>
    {
        if(type in CACHE)
        {
            jQuery(this.newProductContainer).html(CACHE[type]);
            return false;
        }

        if(this.lockNewProduct)
            return false;

        this.lockNewProduct = true;

        loader.show();


        axios.get(HOME_PRODUCT_URL + type, null, {accept: 'application/json'}).then(({data}) => {

            CACHE[type] = data.view;

            this.lockNewProduct = false;

            loader.hide();

            jQuery(this.newProductContainer).html(data.view);


        }).catch(error => {

            this.lockNewProduct = false;
            loader.hide();
        });
    }



}

new Home();