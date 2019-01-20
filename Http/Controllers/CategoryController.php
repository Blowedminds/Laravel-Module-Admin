<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');

        $this->middleware('admin')->except([
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

    public function postCategory($category_id)
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'slug' => 'required'
        ]);

        $category = Category::findOrFail($category_id);

        $category->name = request()->input('name');

        $category->description = request()->input('description');

        $category->slug = request()->input('slug');

        $category->save();

        return response()->json(['TEBRIKLER']);
    }

    public function putCategory()
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'slug' => 'required'
        ]);

        $category = Category::create([
            'name' => request()->input('name'),
            'description' => request()->input('description'),
            'slug' => request()->input('slug')
        ]);

        return response()->json($category);
    }

    public function deleteCategory($id)
    {
        Category::findOrFail($id)->forceDelete();

        return response()->json(['TEBRIKLER']);
    }

}
