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
            'description' => 'required',
            'custom-gif-url' => 'required',
        ]);

        $article = new Post;
        $article->description = $request['description'];
        $article->gif = $request->input('custom-gif-url');
        $article->user_id = $request->user()->id;
        $article->save();
    }

    public function deletePost($id) {
        Post::destroy($id);
    }
    
}
