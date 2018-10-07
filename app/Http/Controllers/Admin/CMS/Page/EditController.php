<?php
/**
 * Created by PhpStorm.
 * User: Kamlesh
 * Date: 10/31/2017
 * Time: 6:34 PM
 */

namespace App\Http\Controllers\Admin\CMS\Page;

use App\Http\Requests\Admin\CMS\Page\UpdateRequest;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Page;

class EditController extends AdminController
{
    public function edit(Page $page)
    {
        return view('admin.cms.page.edit', compact('page'));
    }

    public function update(Page $page, UpdateRequest $updateRequest)
    {
        $updateRequest->request->set('is_active', $updateRequest->is_active ?: false);

        $page->update($updateRequest->all());

        return redirect()->back()
            ->with($this->setMessage('Page has been successfully updated', self::MESSAGE_SUCCESS));
    }
}