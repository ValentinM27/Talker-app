<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Controllers\UserController;

class PostController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new UserController;
    }

    public function createPost(Request $request)
    {
        $data = $request->validate([
            'content' => 'string|required',
            'id_category' => 'string|required|exists:categories,id'
        ]);

        $data['id_user'] = $this->user->getUserUUID();

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
