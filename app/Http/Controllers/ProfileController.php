<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        //recabar info de Posts minificada
        return view('profile');
    }
}
