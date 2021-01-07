<?php

namespace App\Http\Controllers;

use App\Models\FollowingUser;
use Illuminate\Http\Request;

class FollowingUserController extends Controller
{
    public function createFollowing(Request $request) {

        $user_followed_id = //Catch user_followed_id 

        $article = new FollowingUser();
        $article->user_followed_id = $user_followed_id;
        $article->user_id = $request->user()->id;
        $article->save();
        return back();
    }

    public function getAllFollowing(){
        $posts = FollowingUser::all();

        return $posts;
    }
    

    
}
