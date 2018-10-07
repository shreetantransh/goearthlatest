<?php

namespace App\Http\Controllers\Admin\Banner;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Banner\UpdateRequest;
use App\Models\Banner;

class EditController extends AdminController
{
    public function __invoke(Banner $banner)
    {
        return view('admin.banner.create', compact('banner'));
    }

    public function update(UpdateRequest $request, Banner $banner)
    {

        if($request->hasFile('banner_image'))
        {

            if($banner->hasBannerImage())
                \File::delete($banner->getImageUrl());

            $path = $request->banner_image->store(Banner::IMAGE_PATH);

            $request->request->set('image', $path);
        }

        $request->request->set('is_active', $request->is_active ?: FALSE);

        $banner->update($request->all());

        return redirect()->route('admin.banner.edit', $banner->id)->with($this->setMessage('Banner successfully updated', self::MESSAGE_SUCCESS));
    }

    public function destroy(Banner $banner)
    {

        if($banner->hasBannerImage())
            \File::delete($banner->getImageUrl());

        $banner->delete();

        return redirect()->route('admin.banner.all')->with($this->setMessage('Banner successfully deleted', self::MESSAGE_SUCCESS));

    }
}
