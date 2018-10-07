<?php
/**
 * Created by PhpStorm.
 * User: Kamlesh
 * Date: 10/31/2017
 * Time: 6:32 PM
 */

namespace App\Http\Controllers\Admin\CMS\Page;

use App\Models\Page;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\CMS\Page\CreateRequest;

class CreateController extends AdminController
{
    public function create()
    {
        $page = new Page();
        return view('admin.cms.page.edit', compact('page'));
    }

    public function store(CreateRequest $createRequest)
    {
        $page = Page::create($createRequest->all());
        return redirect()->route('admin.cms.page.edit', $page->id);
    }
}