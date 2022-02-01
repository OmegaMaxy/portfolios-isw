<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $users = \App\Models\User::all();
        return view('home', compact('users'));
    }
}
