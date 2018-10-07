<?php
/**
 * Created by PhpStorm.
 * Customer: Kamlesh
 * Date: 11/1/2017
 * Time: 5:10 PM
 */

namespace App\Http\Controllers\Admin\Catalog\Category;

use App\Models\Category;
use App\Http\Controllers\Admin\AdminController;

class DeleteController extends AdminController
{
    public function __invoke(Category $category)
    {

        if($category->hasImage()){
            \File::delete($category->getImageUrl());
        }

        $category->delete();

        return redirect()
            ->route('admin.catalog.category.grid')
            ->with($this->setMessage('Category successfully deleted', self::MESSAGE_SUCCESS));
    }
}