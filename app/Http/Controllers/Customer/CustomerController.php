<?php
/**
 * Created by PhpStorm.
 * User: bay
 * Date: 4/9/2018
 * Time: 7:14 PM
 */

namespace App\Http\Controllers\Customer;

use App\Models\Customer;
use App\Http\Controllers\Frontend\FrontendController;

class CustomerController extends FrontendController
{
    protected $customer;

    /**
     * CustomerController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        view()->share('_customer_tabs', [
            'customer.dashboard' => [
                'label' => 'Dashboard',
                'icon' => 'fa fa-th-large',
                'pattern' => 'customer/dashboard*'
            ],
            'customer.account.index' => [
                'label' => 'My Account',
                'icon' => 'fa fa-user-circle',
                'pattern' => 'customer/account'
            ],
            'customer.address.index' => [
                'label' => 'My Addresses',
                'icon' => 'fa fa-map-marker',
                'pattern' => 'customer/address*'
            ],
            'customer.order.index' => [
                'label' => 'My Orders',
                'icon' => 'fa fa-clock-o',
                'pattern' => 'customer/order*'
            ],
            'customer.review.index' => [
                'label' => 'My Reviews',
                'icon' => 'fa fa-pencil-square-o',
                'pattern' => 'customer/review*'
            ],
            'customer.wishlist.index' => [
                'label' => 'My Favourites',
                'icon' => 'fa fa-heart',
                'pattern' => 'customer/favourites*'
            ]
        ]);
    }

    /**
     * @return Customer|null
     */
    public function getCustomer()
    {
        if ($this->customer) {
            return $this->customer;
        }

        $this->customer = auth('customer')->user();
        return $this->customer;
    }
}