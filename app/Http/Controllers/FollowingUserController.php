<?php

namespace App\Http\Controllers;

use App\Models\FollowingUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowingUserController extends Controller
{
    
    public function followingFilter($user_following_id){
        $followingStatus = FollowingUser::select()
                                            ->where('user_following_id',$user_following_id)
                                            ->where('user_id',Auth::user()->id);

        if($followingStatus->count() > 0){
            $this->deleteFollowing($user_following_id);
            return 0;

        } else{
            $this->createFollowing($user_following_id);
            return 1;
        }      


    }
    
    public function createFollowing($user_following_id)
    {
        $article = new FollowingUser();
        $article->user_following_id = $user_following_id;
        $article->user_id = Auth::user()->id;
        $article->save();
        return back();
    }

    public function deleteFollowing($user_following_id) {
        FollowingUser::where('user_following_id',$user_following_id)
                        ->where('user_id',Auth::user()->id)
                        ->delete();
    }

    public function getAllFollowing()
    {
        $posts = FollowingUser::all();

        return $posts;
    }
}
