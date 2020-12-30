<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    //
    public function createPost(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'gif' => 'required',
        ]);
        

        $article = new Post;
        $article->slug = Str::random(11);
        $article->title = $request->title;
        $article->description = $request->description;
        $article->gif = $request->gif;
        $article->user_id = $request->user()->id;
        $article->save();
        return back();
    }
}
