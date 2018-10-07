<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends AdminController
{
    use AuthenticatesUsers;

    protected $redirectTo;

    public function __construct()
    {
        $this->redirectTo = route('admin.dashboard');
        $this->middleware('guest:admin')->except('logout');
    }

    public function showForm()
    {
        return view('admin.auth.login');
    }

    public function username()
    {
        return 'username';
    }

    protected function guard()
    {
        return \Auth::guard('admin');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect()->route('admin.auth.login');
    }
}