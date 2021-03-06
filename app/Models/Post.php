<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'gif'];

    protected $hiddenForPost = ['updated_at', 'created_at', 'slug', 'title', 'user_id'];

    protected $hiddenForPostCards = ['updated_at', 'created_at', 'slug', 'title', 'user_id', 'description'];
    
    protected $hiddenForLikesDislikes = ['updated_at', 'created_at', 'slug', 'title', 'user_id', 'description','gif'];
    
    public function getPostInfo()
    {
        $this->comments;
        $this->user;
        $this->likesUsers;
        $this->dislikesUsers;

        $collection = collect($this);

        // counting items into collection
        $collection->put('comments_count', $this->commentsCount());
        $collection->put('likes_count', $this->likesUsers->count());
        $collection->put('dislikes_count', $this->dislikesUsers->count());
        $collection->put('like_status', $this->likeStatus());

        return $collection;
    }

    public function getPostsProfileInfo()
    {

        $collection = collect($this);

        // counting items into collection
        $collection->put('comments_count', $this->commentsCount());
        $collection->put('likes_count', $this->likesUsers->count());
        $collection->put('dislikes_count', $this->dislikesUsers->count());
        $collection->put('like_status', $this->likeStatus());

        return $collection->except($this->hiddenForPostCards);
    }

    public function getAllLikeDislikes()
    {

        $collection = collect($this);

        // counting items into collection
        $collection->put('likes_count', $this->likesUsers->count());
        $collection->put('dislikes_count', $this->dislikesUsers->count());

        return $collection->except($this->hiddenForLikesDislikes);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->select('users.name as name', 'users.user_name as username', 'comments.description', 'comments.id')
            ->take(2);
    }
    public function commentsCount(){
        return $this->hasMany(Comment::class)
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->select('users.name as name', 'users.user_name as username', 'comments.description', 'comments.id')
            ->count();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->select('name', 'profile_photo_path', 'user_name');
    }

    public function likesUsers()
    {
        // return $this->hasManyThrough(User::class, LikeDislikePost::class, 'user_id', 'id','id','post_id')->select('name', 'profile_photo_path');
        return $this->hasMany(LikeDislikePost::class)->where('status', 1)
            ->join('users', 'users.id', '=', 'like_dislike_posts.user_id')
            ->select('users.name', 'users.user_name as user_username');
    }

    public function dislikesUsers()
    {
        // return $this->hasManyThrough(User::class, LikeDislikePost::class, 'user_id', 'id','id','post_id')->select('name', 'profile_photo_path');
        return $this->hasMany(LikeDislikePost::class)->where('status', 2)
            ->join('users', 'users.id', '=', 'like_dislike_posts.user_id')
            ->select('users.name', 'users.user_name as user_username');
    }


    public function likeStatus()
    {
        $status = $this->hasOne(LikeDislikePost::class)->where('user_id', Auth::user()->id)->select('status')->first();

        if (!$status) {
            return 0;
        }
        return $status['status'];
    }

    public static function getGifsCount($user)
    {
        return $user->hasMany(Post::class)->count();
    }
}
