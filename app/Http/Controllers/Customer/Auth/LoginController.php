<?php
/**
 * Created by PhpStorm.
 * User: bay
 * Date: 4/9/2018
 * Time: 7:14 PM
 */

namespace App\Http\Controllers\Customer\Auth;

use App\Logic\Cart;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Customer\CustomerController;

class LoginController extends CustomerController
{
    use AuthenticatesUsers;

    protected $sessionCart;

    public function __construct(Cart $cart)
    {
        parent::__construct();

        $this->middleware('guest:customer')->except('logout');

        $this->middleware(function(Request $request, \Closure $next) {

            $this->sessionCart = $this->cart->getCart();

            return $next($request);
        });

    }

    public function showForm()
    {
        $responseHandlerFields = [];

        if (request('responseHandler')) {
            switch (request('responseHandler')) {
                case 'reloadSelf':
                    $responseHandlerFields['responseHandler'] = 'reloadSelf';
                    break;
            }
        }

        return view('customer.auth.account', compact('responseHandlerFields'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }

    /**
     * @param Request $request
     * @param $customer
     * @return \Illuminate\Http\JsonResponse
     * @internal param Customer $user
     */
    protected function authenticated(Request $request, Customer $customer)
    {
        $customer->syncCart($this->sessionCart);
        $this->sessionCart->delete();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'responseHandler' => \request('responseHandler'),
                'redirectUrl' => redirect()->intended(route('customer.dashboard'))->getTargetUrl()
            ]);
        }
    }

    protected function guard()
    {
        return auth('customer');
    }
}