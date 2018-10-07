const axios = require('axios');
const loader = require('./../components/Loader');

class LayeredNav {

    constructor() {

        this.productContainerList = $('#catalog-product-list');
        this.productContainerGrid = $('#catalog-product-grid');

        if (this.productContainerGrid.length < 1) {
            return;
        }

        this.pager = {
            currentPage: 1,
            lastPage: 1,
            lock: false
        };

        this.xhr = null;
        this.history = window.history;
        this.serializeFilter = '';

        this._loadProducts();

        $('.filter input:checkbox').on('change', this._onFilterChangeHandler);
        $(window).scroll(this._handleWindowScroll);
    }

    _handleWindowScroll = () => {

        var win = $(window);

        /* Already a request in pending */
        if (this.pager.lock) {
            return;
        }

        /* Reached to last page */
        if (this.pager.currentPage >= this.pager.lastPage) {
            return;
        }

        /* check and load more */
        if ($(document).height() - win.height() - 400 <= win.scrollTop()) {
            this.pager.currentPage += 1;
            this._loadProducts(this.pager.currentPage);
        }
    }

    _onFilterChangeHandler = (e) => {

        this.serializeFilter = $(e.target).closest('form').serialize();

        if (this.serializeFilter !== '') {
            this.serializeFilter = '?' + this.serializeFilter;
        }

        this.history.replaceState(null, window.title, APP_CURRENT_URL + this.serializeFilter);

        this._loadProducts(1, true);
        loader.show();
    }

    _loadProducts = (page = 1, reset = false, callback = f => f) => {

        const data = this.serializeFilter ? this.serializeFilter + '&page=' + page : '?page=' + page;

        if (this.xhr !== null) {
            this.xhr.abort();
        }

        this.pager.lock = true;

        axios.get(APP_CURRENT_URL + data, {responseType: 'json', header: {accept: 'application/json'}})
            .then((res) => {

                if (reset) {
                    this.productContainerGrid.html(res.data.grid);
                    this.productContainerList.list(res.data.list);
                    this._setWindowPosition();
                } else {
                    this.productContainerGrid.append(res.data.grid);
                    this.productContainerList.append(res.data.list);
                }

                this.pager.lock = false;
                this.pager.lastPage = res.data.last_page;

                loader.hide();

                callback(this);
            });
    }

    _setWindowPosition = () => {

        const categoryMainTopPosition = $('#category-main').position().top;
        const windowScrollTop = $(window).scrollTop();

        if (windowScrollTop < categoryMainTopPosition) {
            return;
        }

        $('html, body').animate({
            scrollTop: categoryMainTopPosition
        });
    }
}

new LayeredNav();