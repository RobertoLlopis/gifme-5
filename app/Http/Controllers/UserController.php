<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUsers(Request $request)
    {
        // return User::all()->select('id','user_name');
        // return User::all();
        return json_encode($request['search']);
    }
}
