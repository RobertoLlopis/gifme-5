<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowingUser extends Model
{
    use HasFactory;

    protected $hidden = ['updated_at', 'created_at', 'user_id'];

    public function getFollowingUserInfo()
    {
        $this->followingUser;

        $collection = collect($this);

        return $collection->except($this->hidden);
    }

    public function followingUser()
    {
        return $this->hasOne(User::class, 'id', 'user_following_id')->select('name', 'user_name', 'profile_photo_path');
    }

    public static function getFollowingCount($user)
    {
        return $user->hasMany(FollowingUser::class)->count();
    }

    public static function getFollowersCount($user)
    {
        return $user->hasMany(FollowingUser::class, 'user_following_id')->count();
    }
}
