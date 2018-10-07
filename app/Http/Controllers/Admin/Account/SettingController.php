<?php

namespace App\Http\Controllers\Admin\Account;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function __invoke()
    {
        $setting = AdminUser::first();

        return view('admin.account.setting', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = AdminUser::first();

        $values = $request->all();

        if($request->hasFile('image'))
        {

            if($setting->hasLogo())
                \File::delete($setting->getLogoUrl());

            $path = $request->image->storeAs(AdminUser::LOGO_PATH, 'logo.png');

            $values['image'] = $path;
        }

        if($request->hasFile('footer_logo'))
        {

            if($setting->hasFooterLogo())
                \File::delete($setting->getFooterLogoUrl());

            $footer_path = $request->footer_logo->storeAs(AdminUser::LOGO_PATH, 'footer.png');

            $values['footer_logo'] = $footer_path;
        }

        $setting->update($values);

        return redirect()->route('admin.setting')->with($this->setMessage('Account setting successfully updated', self::MESSAGE_SUCCESS));
    }
}
