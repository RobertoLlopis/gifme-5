<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CommentController extends Controller
{
    public function createComment(Request $request)
    {
        $this->validate($request, [
            'postId' => 'required',
            'comment' => 'required'
        ]);

        $article = new Comment();
        $article->slug = Str::random(11);
        $article->post_id = $request->postId;
        $article->description = $request->comment;
        $article->user_id = $request->user()->id;
        $article->save();

        return $request->comment;
    }

    function getCommentById($post_id){

        $comments = new Comment();
        return $comments->getComment($post_id);
    }
}
