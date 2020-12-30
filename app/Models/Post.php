<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title','description','gif'];

    protected $hiddenForPost = ['updated_at','created_at','slug','title','user_id'];

    public function getPostInfo(){
        $this->comments;
        $this->user;
        $this->favourites;

        $collection = collect($this);

        // counting items into collection
        $collection->put('comments_count',$this->comments->count());
        $collection->put('favourites_count',$this->favourites->count());

        return $collection->except($this->hiddenForPost);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)
        ->join('users','users.id','=','comments.user_id')
        ->select('users.name as username','comments.description','comments.id');
    }

    public function user()
    {
        return $this->belongsTo(User::class)->select('name','profile_photo_path');
    }

    public function favourites()
    {
        return $this->hasManyThrough(User::class,FavouritePost::class,'user_id','id')->select('name','profile_photo_path');
    }

    

}
