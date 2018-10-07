<?php
/**
 * Created by PhpStorm.
 * Customer: Kamlesh
 * Date: 10/31/2017
 * Time: 6:34 PM
 */

namespace App\Http\Controllers\Admin\Catalog\Category;

use App\Models\Category;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\Catalog\Category\UpdateRequest;

class EditController extends AdminController
{
    public function edit(Category $category)
    {
        $categories = Category::active()->root()->where('id', '!=', $category->id)->get();
        return view('admin.catalog.category.edit', compact('category', 'categories'));
    }

    public function update(Category $category, UpdateRequest $updateRequest)
    {

        if ($updateRequest->hasFile('icon')) {

            if ($category->hasImage()) {
                \File::delete($category->getImageUrl());
            }

            $path = $updateRequest->icon->store(Category::IMAGE_PATH);
        }

        $updateRequest->request->set('image', isset($path) ? $path : NULL);
        $updateRequest->request->set('parent_id', $updateRequest->parent_category);
        $updateRequest->request->set('is_active', $updateRequest->is_active ?: false);
        $updateRequest->request->set('add_to_menu', $updateRequest->add_to_menu ?: false);


        $category->update($updateRequest->all());

        return redirect()->route('admin.catalog.category.edit', $category->slug)
            ->with($this->setMessage('Category has been successfully updated', self::MESSAGE_SUCCESS));
    }
}