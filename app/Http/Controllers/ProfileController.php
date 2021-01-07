<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($id)
    {
        return view('profile', ['posts' => $this->getPostsCardsInfo($id)]);
    }

    public function getPostsCardsInfo($id){
        $profilePosts = Post::all()->where('user_id',$id);
        $outputPosts = [];

        foreach ($profilePosts as $post){
            $postInfo = $post->getPostInfo();
            array_push($outputPosts,$postInfo);
        }

        return $outputPosts;
    }
}
