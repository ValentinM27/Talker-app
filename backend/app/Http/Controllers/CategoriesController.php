<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class CategoriesController extends Controller
{
    public function createCategory(Request $request)
    {
        $data = $request->validate([
            'label' => 'string|required|unique:categories,label'
        ]);

        $data['id'] = Str::uuid();

        $category = new Category();
        $category->fill($data);
        $category->id = Str::uuid();
        $category->save();

        return $category;
    }

    public function getCategories()
    {
        return Category::get();
    }

    public function getPostsbyCategory(String $idCategory){
        return Post::where('id_category', $idCategory)->get();
    }
}
