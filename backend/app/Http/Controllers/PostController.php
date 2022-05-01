<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Http\Controllers\UserController;

class PostController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new UserController;
    }

    public function createPost(Request $request, Category $category)
    {
        $data = $request->validate([
            'content' => 'string|required',
        ]);

        $data['id_user'] = $this->user->getUserUUID();
        $data['id_category'] = $category->id;

        $post = new Post();
        $post->fill($data);
        $post->id = Str::uuid();
        $post->save();

        return $post;
    }

    public function deletePost(Post $post)
    {
        return $post->delete();
    }

    public function getById(Post $post)
    {
        return $post;
    }
}
