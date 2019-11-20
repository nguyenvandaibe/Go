<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function showPersonalPage()
    {
        return view('my_profile', ['user', Auth::user()]);
    }
}
