<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            switch ($guard) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'customer':
                    return $this->_handleCustomerRedirect($request);
                default:
                    return redirect('/home');
            }
        }

        return $next($request);
    }

    private function _handleCustomerRedirect($request)
    {
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'redirectUrl' => redirect()->intended(route('customer.dashboard'))->getTargetUrl()
            ]);
        }

        return redirect()->intended(route('customer.dashboard'));
    }
}
