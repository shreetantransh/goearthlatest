<?php

namespace App\Http\Controllers\Admin;

class DashboardController extends AdminController
{
    public function __invoke()
    {
        return view('admin.dashboard');
    }
}