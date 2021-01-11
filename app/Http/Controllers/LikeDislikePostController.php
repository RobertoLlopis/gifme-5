<?php

namespace App\Http\Controllers;

use App\Models\LikeDislikePost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeDislikePostController extends Controller
{
    //
    public function likeDislikeFilter(Request $request){
        $rowExists = LikeDislikePost::select()
                                    ->where('post_id',$request['post_id'])
                                    ->where('user_id',Auth::user()->id);
                        
        if($rowExists->count() > 0){
            // return $rowExists->select('status');
            // return 'exists';
            if($rowExists->first()['status'] == $request['post_status']){
                $this->deleteLikeDislike($request['post_id']);
                return 0;
            }else{
                $this->updateLikeDislikeStatus($request['post_id'],$request['post_status']);
                return $request['post_status'];
            }
        } else{
            $this->createLikeDislike($request['post_id'],$request['post_status']);
            // return 'doesnt exists';
            return $request['post_status'];
        }        

    }
    public function createLikeDislike($post_id,$post_status)
    {
        $article = new LikeDislikePost();
        $article->post_id = $post_id;
        $article->user_id = Auth::user()->id;
        $article->status = $post_status;
        $article->save();
        return back();
    }

    public function deleteLikeDislike($post_id) {
        LikeDislikePost::where('post_id',$post_id)->delete();
    }

    public function updateLikeDislikeStatus($post_id,$post_status){
        LikeDislikePost::where('post_id',$post_id)
                        ->where('user_id',Auth::user()->id)
                        ->update(['status'=>$post_status]);
    }


}