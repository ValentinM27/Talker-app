<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Controllers\UserController;

class PostController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = new UserController;
    }

    public function createPost(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'content' => 'string|required',
            'id_category' => 'string|required|exists:categories,id'
        ]);

        if($validate->fails()){
            return response()->json([
                $validate->errors()->all()
            ], 403);
        }

        $data = $validate->getData();
        $data['id_user'] = $this->user->getUserUUID();

        $post = new Post();
        $post->fill($data);
        $post->id = Str::uuid();
        $post->save();

        return $post;
    }

    public function deletePost(Post $post)
    {
        $userUUID = $this->user->getUserUUID();

        if($post->id_user === $userUUID) {
            return $post->delete();
        }

        return response("Vous n'êtes pas le créateur de ce post", 403);
    }
}
