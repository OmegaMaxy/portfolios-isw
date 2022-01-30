<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        // delete notification should be received here
        $users = User::all();
        return view('users.overview', ['users' => $users]);
    }
    public function show($userId)
    {
        $user = User::findOrFail($userId);

        $markdown_portfolio = ""; // based of $user->activePage()->page_url
        return view('users.show', compact('user', 'markdown_portfolio'));
    }
}
