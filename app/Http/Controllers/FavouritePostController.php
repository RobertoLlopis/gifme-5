<?php

namespace App\Http\Controllers;

use App\Models\FavouritePost;
use Illuminate\Http\Request;

class FavouritePostController extends Controller
{
    //
    public function createComment(Request $request) {

        $postId = //Catch post_id 

        $article = new FavouritePost();
        $article->post_id = $postId;
        $article->user_id = $request->user()->id;
        $article->save();
        return back();
    }
}
