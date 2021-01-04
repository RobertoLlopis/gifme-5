<?php

namespace App\Http\Controllers;

use App\Models\LikePost;
use Illuminate\Http\Request;

class LikePostController extends Controller
{
    //
    public function createLikePost(Request $request) {

        $postId = //Catch post_id 

        $article = new LikePost();
        $article->post_id = $postId;
        $article->user_id = $request->user()->id;
        $article->save();
        return back();
    }
}
