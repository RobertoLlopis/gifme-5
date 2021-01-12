<?php

namespace App\Http\Controllers;

use App\Models\FollowingUser;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function index($user_id)
    {
        $profile = $this->getProfileUserInfo($user_id);
        $posts = $this->getPostsCardsInfo($user_id);
        $following_status = $this->profileFollowingStatus($user_id);
        $is_user_active = $this->checkUserActive($user_id);

        return view('profile', compact('posts', 'profile', 'following_status','is_user_active'));
        // return compact('profile', 'posts', 'user_id', 'following_status','is_user_active');
    }

    public function byUserName($user_name)
    {
        $user_id = User::where('user_name', $user_name)->get()->first()['id'];
        return redirect()->route('profile', ['user_id' => $user_id]);
        /*  return $this->index(strval(User::where('user_name', $user_name)->get()->first()['id'])); */
    }


    public function getPostsCardsInfo($user_id)
    {
        $profilePosts = Post::all()->where('user_id', $user_id);
        $outputPosts = [];

        foreach ($profilePosts as $post) {
            $postInfo = $post->getPostsProfileInfo();
            array_push($outputPosts, $postInfo);
        }

        return $outputPosts;
    }

    public function getProfileUserInfo($user_id)
    {
        $profile_info =  User::all('user_name', 'id', 'title', 'description', 'name')->find($user_id);
        $gifs_count = Post::getGifsCount($profile_info);
        $followers = FollowingUser::getFollowersCount($profile_info);
        $following = FollowingUser::getFollowingCount($profile_info);

        return compact('profile_info', 'gifs_count', 'followers', 'following');
    }

    public function profileFollowingStatus($user_id)
    {
        $followingStatus = FollowingUser::select()->where('user_following_id', $user_id)
            ->where('user_id', Auth::user()->id);

        if ($followingStatus->count() > 0) {
            return 1;
        }
        return 0;
    }

    public function checkUserActive($user_id){
        if($user_id == Auth::user()->id){
            return true;
        } 
        return false;
    }
}
