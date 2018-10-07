<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Logic\Cart;
use App\Models\AdminUser;

class FrontendController extends Controller
{
    /**
     * @var Cart
     */
    protected $cart;
    protected $setting;

    public function __construct()
    {
        $this->cart = new Cart();
        view()->share('_cart', $this->cart);

        $this->setting = AdminUser::first();
        view()->share('_setting', $this->setting);
    }
}
