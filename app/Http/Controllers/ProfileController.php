<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function index($user_id)
    {
        $posts = $this->getPostsCardsInfo($user_id);
        return view('profile', compact('posts', 'user_id'));
    }

    public function getPostsCardsInfo($user_id)
    {
        $profilePosts = Post::all()->where('user_id', $user_id);
        $outputPosts = [];

        foreach ($profilePosts as $post) {
            $postInfo = $post->getPostInfo();
            array_push($outputPosts, $postInfo);
        }

        return $outputPosts;
    }
}
