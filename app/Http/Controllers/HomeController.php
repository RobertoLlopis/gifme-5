<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $posts;
    public function __construct(){
        //Coger info de Post model
        // $this->posts = .....
    }
    public function index()
    {
        //Recabar la info de los posts as $posts
        return view('home');
    }
}
