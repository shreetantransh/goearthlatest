<?php
/**
 * Created by PhpStorm.
 * User: Kamlesh
 * Date: 11/1/2017
 * Time: 5:10 PM
 */

namespace App\Http\Controllers\Admin\CMS\Page;

use App\Models\Page;
use App\Http\Controllers\Admin\AdminController;

class DeleteController extends AdminController
{
    public function __invoke(Page $page)
    {
        $page->delete();

        return redirect()
            ->route('admin.cms.page.grid')
            ->with($this->setMessage('Page has been successfully deleted.', self::MESSAGE_SUCCESS));
    }
}