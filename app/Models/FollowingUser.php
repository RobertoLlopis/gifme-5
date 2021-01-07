<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowingUser extends Model
{
    use HasFactory;

    protected $hidden = ['updated_at','created_at','user_id','user_following_id'];

    public function getFollowingUserInfo()
    {
        $this->followingUser;

        $collection = collect($this);

        return $collection->except($this->hidden);
    }
    
    public function followingUser(){

        return $this->hasOne(User::class,'id','user_following_id')->select('user_name','profile_photo_path');
    }
    
}
