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
            'comment' => 'required'
        ]);

        $article = new Comment();
        $article->slug = Str::random(11);
        $article->description = $request->description;
        $article->user_id = $request->user()->id;
        $article->save();
        return back();
    }
}
