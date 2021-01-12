<?php

namespace App\Http\Controllers;

use App\Models\LikeDislikePost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeDislikePostController extends Controller
{
    //
    public function likeDislikeFilter(Request $request){
        $post_id = $request['post_id'];
        $post_status = $request['post_status'];

        $rowExists = LikeDislikePost::select()
                                    ->where('post_id',$post_id)
                                    ->where('user_id',Auth::user()->id);
                        
        if($rowExists->count() > 0){
            if($rowExists->first()['status'] == $post_status){
                $this->deleteLikeDislike($post_id);
                return LikeDislikePost::getPostLikesDislikes($post_id);
            }else{
                $this->updateLikeDislikeStatus($post_id,$post_status);
                return LikeDislikePost::getPostLikesDislikes($post_id);
            }
        } else{
            $this->createLikeDislike($post_id,$post_status);
            return LikeDislikePost::getPostLikesDislikes($post_id);
        }        
        
    }
    
    public function createLikeDislike($post_id,$post_status)
    {
        $article = new LikeDislikePost();
        $article->post_id = $post_id;
        $article->user_id = Auth::user()->id;
        $article->status = $post_status;
        $article->save();
    }
    
    public function deleteLikeDislike($post_id) {
        LikeDislikePost::where('post_id',$post_id)
        ->where('user_id',Auth::user()->id)
        ->delete();
    }
    
    public function updateLikeDislikeStatus($post_id,$post_status){
        LikeDislikePost::where('post_id',$post_id)
        ->where('user_id',Auth::user()->id)
        ->update(['status'=>$post_status]);
    }
    
    public function getLikesDislikes(Request $request){
        // $arrayPosts = $request['rendered_posts'];

        $arrayPosts = [1,2,3,4,5,6];

        $posts = Post::all();

        foreach($posts as $post){
            $post->getAllLikeDislikes();
        }

        return $posts;





        // return LikeDislikePost::getAllLikeDislikes();
        
    }
    
    
    
    
    
}