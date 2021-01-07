<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        //Recabar la info de los posts as $posts
        return view('profile');
    }
}
