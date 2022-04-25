<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class CategoriesController extends Controller
{
    public function createCategory(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'label' => 'string|required|unique:categories,label'
        ]);

        if($validate->fails()){
            return response()->json([
                $validate->errors()->all()
            ], 403);
        }

        $date = $validate->getData();
        $date['id'] = Str::uuid();

        $category = new Category();
        $category->fill($date);
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
