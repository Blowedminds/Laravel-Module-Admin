<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');

        $this->middleware('permission:ownership.category')->except([
            'getCategories'
        ]);
    }

    public function getCategories()
    {
        $categories = Category::all()->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
                'description' => $category->description
            ];
        });

        return response()->json($categories);
    }

    public function postCategory()
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'slug' => 'required'
        ]);

        Category::create(request()->only(['name', 'description', 'slug']));

        return response()->json();
    }

    public function putCategory($category_id)
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'slug' => 'required'
        ]);

        $category = Category::findOrFail($category_id);

        $category->update(request()->only(['name', 'description', 'slug']));

        return response()->json();
    }

    public function deleteCategory($id)
    {
        Category::findOrFail($id)->forceDelete();

        return response()->json();
    }

}
