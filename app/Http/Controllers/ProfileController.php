<?php

namespace App\Http\Controllers;

use App\Models\FollowingUser;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function index($user_id)
    {
        $profile = $this->getProfileUserInfo($user_id);
        $posts = $this->getPostsCardsInfo($user_id);

        return view('profile', compact('posts', 'profile'));
        //return compact('profile', 'posts', 'user_id');
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
        $profile_info =  User::all('user_name', 'id', 'title', 'description')->find($user_id);
        $gifs_count = Post::getGifsCount($profile_info);
        $followers = FollowingUser::getFollowersCount($profile_info);
        $following = FollowingUser::getFollowingCount($profile_info);

        return compact('profile_info', 'gifs_count', 'followers', 'following');
    }
}
