<?php
/**
 * Created by PhpStorm.
 * Customer: Kamlesh
 * Date: 10/31/2017
 * Time: 6:32 PM
 */

namespace App\Http\Controllers\Admin\Catalog\Category;

use App\Models\Category;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\Catalog\Category\CreateRequest;


class CreateController extends AdminController
{

    public function create()
    {
        $category = new Category();

        $categories = Category::active()->root()->get();

        return view('admin.catalog.category.edit', compact('category', 'categories'));
    }

    public function store(CreateRequest $createRequest)
    {

        if ($createRequest->hasFile('icon')) {
            $path = $createRequest->icon->store(Category::IMAGE_PATH);
        }

        $data = [
            'name' => $createRequest->name,
            'description' => $createRequest->description,
            'meta_title' => $createRequest->meta_title,
            'meta_keywords' => $createRequest->meta_keywords,
            'meta_description' => $createRequest->meta_description,
            'is_active' => $createRequest->is_active ? "1" : "0",
            'image' => isset($path) ? $path : NULL,
            'parent_id' => $createRequest->parent_category,
            'add_to_menu' => $createRequest->add_to_menu ?: false
        ];


        $category = Category::create($data);

        return redirect()->route('admin.catalog.category.edit', $category->slug);
    }
}