<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUsers(Request $request)
    {
        // return User::all()->select('id','user_name');
        return json_encode(User::where('user_name','LIKE',$request['search'].'%')->get());
        // return $request['search'];
    }
}
