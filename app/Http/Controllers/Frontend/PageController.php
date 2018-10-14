<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Faq;
use App\Models\Help;
use App\Models\Package;
use Cookie;
use Carbon\Carbon;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends FrontendController
{

    private function getPage($slug)
    {
        return Page::slug($slug)->active()->FirstOrFail();
    }

    public function about()
    {
        $page = $this->getPage('about-us');

        return view('frontend.page.index', compact('page'));
    }
    public function terms()
    {
        $page = $this->getPage('terms-and-conditions');
        return view('frontend.page.index', compact('page'));
    }
    public function privacy()
    {
        $page = $this->getPage('privacy-policy');
        return view('frontend.page.index', compact('page'));
    }

    public function contactUs()
    {
        return view('frontend.page.contact');
    }
}
