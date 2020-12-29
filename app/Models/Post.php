<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title','description','gif'];

    public function getPostInfo($postId){
        $post = Post::find($postId);
        $post->comments;
        $post->user;

        return $post;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)
        ->join('users','users.id','=','comments.id')
        ->select('users.name','comments.description');
    }

    public function user()
    {
        return $this->belongsTo(User::class)->select('name','profile_photo_path');
    }

    

}
