<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Http\Controllers\UserController;

class CommentController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new UserController;
    }

    public function createComment(Request $request, Post $post)
    {
        $data = $request->validate([
            'content' => 'string|required',
        ]);

        $data['id_user'] = $this->user->getUserUUID();

        $comment = new Comment();
        $comment->fill($data);
        $comment->id_post = $post->id;
        $comment->id = Str::uuid();
        $comment->save();

        return $comment;
    }

    public function deleteComment(Comment $comment)
    {
        return $comment->delete();
    }

    public function getByPostId(Post $post)
    {
        return Comment::where('id_post',$post->id)->get();
    }
}
