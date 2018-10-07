<?php

namespace App\Http\Controllers\Admin\Banner;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Banner\CreateRequest;
use App\Models\Banner;

class CreateController extends AdminController
{
    public function __invoke()
    {
        $banner = new Banner();

        $banner->sequence = Banner::count() + 1;

        return view('admin.banner.create', compact('banner'));
    }

    public function store(CreateRequest $request)
    {
        if($request->hasFile('banner_image'))
        {

            $path = $request->banner_image->store(Banner::IMAGE_PATH);

            $request->request->set('image', $path);
        }

        $request->request->set('is_active', $request->is_active ?: FALSE);

        $banner = Banner::create($request->all());

        return redirect()->route('admin.banner.edit', $banner->id)->with($this->setMessage('Banner successfully saved', self::MESSAGE_SUCCESS));
    }
}
