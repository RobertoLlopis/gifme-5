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

    public function getPostInfo()
    {
        $this->comments;
        $this->user;
        $this->likesPosts;
        $this->dislikesPosts;
        $this->likeStatus;

        $collection = collect($this);

        // counting items into collection
        $collection->put('comments_count', $this->comments->count());
        $collection->put('likes_count', $this->likesPosts->count());
        $collection->put('dislike_count', $this->dislikesPosts->count());

        return $collection->except($this->hiddenForPost);
    }

    public function getPostsProfileInfo()
    {

        $collection = collect($this);

        // counting items into collection
        $collection->put('comments_count', $this->comments->count());
        $collection->put('likes_count', $this->likesPosts->count());
        $collection->put('dislike_count', $this->dislikesPosts->count());

        return $collection->except($this->hiddenForPostCards);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->select('users.name as name', 'users.user_name as username', 'comments.description', 'comments.id')
            ->take(2);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->select('name', 'profile_photo_path', 'user_name');
    }

    public function likesPosts()
    {
        // return $this->hasManyThrough(User::class, LikeDislikePost::class, 'user_id', 'id','id','post_id')->select('name', 'profile_photo_path');
        return $this->hasMany(LikeDislikePost::class)->where('status',1);
    }

    public function dislikesPosts()
    {
        // return $this->hasManyThrough(User::class, LikeDislikePost::class, 'user_id', 'id','id','post_id')->select('name', 'profile_photo_path');
        return $this->hasMany(LikeDislikePost::class)->where('status',2);
    }
    

    public function likeStatus(){
        return $this->hasOne(LikeDislikePost::class)->where('user_id',9)->select('status');

    }

    public static function getGifsCount($user)
    {
        return $user->hasMany(Post::class)->count();
    }
}
