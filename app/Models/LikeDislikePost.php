<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeDislikePost extends Model
{
    use HasFactory;

    public static function getPostLikesDislikes($post_id){

        $hidden = ['id','updated_at', 'created_at', 'slug', 'title', 'user_id','description','gif'];

        $post = Post::find($post_id);
        $post->makeHidden($hidden);

        $post->likesUsers;
        $post->dislikesUsers;

        $postInfo = collect($post)
                    ->toArray();

        // counting items and status into postInfo
        $postInfo['likes_count'] = $post->likesUsers->count();
        $postInfo['dislikes_count'] = $post->dislikesUsers->count();
        $postInfo['like_status'] = $post->likeStatus();

        return $postInfo;
    }

    
}
