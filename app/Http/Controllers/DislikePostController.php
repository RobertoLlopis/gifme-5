<?php

namespace App\Http\Controllers;

use App\Models\DislikePost;
use Illuminate\Http\Request;

class DislikePostController extends Controller
{
    public function createDislikePost(Request $request) {

        $postId = //Catch post_id 

        $article = new DislikePost();
        $article->post_id = $postId;
        $article->user_id = $request->user()->id;
        $article->save();
        return back();
    }
}
