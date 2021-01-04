<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

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
        return view('home', ['posts' => $this->getPostsInfo()]);
    }

    public function getPostsInfo(){
        $posts = Post::all();
        $outputPosts = [];

        foreach ($posts as $post){
            $postInfo = $post->getPostInfo();
            array_push($outputPosts,$postInfo);
        }

        return $outputPosts;
        //return view('delete',['post'=> $outputPosts[1]]);

    }

    public function getUsers(){
        // return User::all()->select('id','user_name');
        return User::all('id','user_name');
    }
}
