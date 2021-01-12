<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['description'];
    
    public function getComments($post_id){

        return $this->where('post_id',$post_id)
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->select('users.id as user_id','users.user_name','comments.description', 'comments.id as comment_id')
            ->get();

    }

}
