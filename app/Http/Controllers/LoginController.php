<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //login
    function getlogin()
    {
        return view('login');
    }
}
