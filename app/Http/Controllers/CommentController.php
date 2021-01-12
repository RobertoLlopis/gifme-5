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

        return [
            'postId' => $request->postId,
            'description'=> $request->comment,
            'user_name'=> $request->user()['user_name']
            ];
    }

    function getCommentsById($post_id){

        $comments = new Comment();
        return $comments->getComments($post_id);
    }
}
