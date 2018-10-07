<?php

namespace App\Http\Controllers\Frontend\Cms;

use App\Http\Controllers\Frontend\FrontendController;
use App\Models\Page;

class IndexController extends FrontendController
{
    public function __invoke($slug)
    {
      $page = Page::active()->slug($slug)->firstOrFail();

      return view('frontend.page.index', compact('page'));
    }
}
