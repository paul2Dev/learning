<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userDashboard()
    {
        return view('user.dashboard');
    }

    public function index()
    {
        return view('frontend.index');
    }
}
