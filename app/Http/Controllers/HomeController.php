<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public $posts;
    public function __construct(){
        //Coger info de Post model
        // $this->posts = .....
    }
    public function index()
    {
        //Recabar la info de los posts as $posts
        return view('home');
    }

    public function getPostsInfo(){
        $postsId = Post::all()->pluck('id');
        $outputPosts = [];

        foreach ($postsId as $postId){
            $post = new Post();
            $postInfo = $post->getPostInfo($postId);
            
            array_push($outputPosts,$postInfo);
        }

        return $outputPosts[1];
        // return view('delete',['post'=> $outputPosts[1]]);

    }
}
