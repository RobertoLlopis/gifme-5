<?php

namespace App\Http\Controllers;

use App\Models\FollowingUser;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public $posts;
    public $following;
    public function __construct()
    {
        //Coger info de Post model
        // $this->posts = .....
    }
    public function index()
    {

        //Recabar la info de los posts as $posts
        $posts = $this->getPostsInfo();
        $following = $this->getAllFollowingById();
        $suggestions = $this->getFollowingSuggestions();

        return view('home', compact('posts', 'following', 'suggestions'));
        // return compact('posts', 'following', 'suggestions');
    }

    public function getPostsInfo()
    {
        $posts = Post::all()->take(5);
        //$posts = Post::all();
        $outputPosts = [];

        foreach ($posts as $post) {
            $postInfo = $post->getPostInfo();
            array_push($outputPosts, $postInfo);
        }

        return $outputPosts;
        //return view('delete',['post'=> $outputPosts[1]]);
    }

    public function getAllFollowingById()
    {
        $followingUsers = FollowingUser::all()
                                        ->where('user_id', Auth::user()->id)
                                        ->whereNotIn('user_following_id', Auth::user()->id);
        $outputPosts = [];
        foreach ($followingUsers as $user) {
            array_push($outputPosts, $user->getFollowingUserInfo());
        }
        return $outputPosts;
    }

    public function getFollowingSuggestions()
    {
        $followingId = FollowingUser::all()
                                    ->where('user_id', Auth::user()->id)
                                    ->pluck('user_following_id')
                                    ->toArray();

        //add active user to array
        array_push($followingId,Auth::user()->id);
                                    
        $suggestions = User::whereNotIn('id', $followingId)
                            ->select('name', 'user_name', 'profile_photo_path', 'id')
                            ->limit(5)
                            ->get();

        return $suggestions;
    }

    public function addComment(Request $request)
    {
        return dd($request->all());
    }
    public function addPost(Request $request)
    {
        return dd($request->all());
    }

    public function getUsers()
    {
        // return User::all()->select('id','user_name');
        return User::all();
    }
    public function getUserInfo($user_id)
    {
        return User::where('id', $user_id)->get();
    }
}
