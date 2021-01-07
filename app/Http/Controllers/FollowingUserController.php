<?php

namespace App\Http\Controllers;

use App\Models\FollowingUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowingUserController extends Controller
{
    public function createFollowing($user_following_id)
    {
        $article = new FollowingUser();
        $article->user_following_id = $user_following_id;
        $article->user_id = Auth::user()->id;
        $article->save();
        return back();
    }

    public function getAllFollowing()
    {
        $posts = FollowingUser::all();

        return $posts;
    }
}
