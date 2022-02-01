<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Page;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function index()
    {
        // delete notification should be received here
        $users = User::all();
        return view('users.overview', ['users' => $users]);
    }
    public function show($username)
    {
        $user = User::where('username', $username)->get()->first();
        if ($user == null) {
            return abort(404);
        }
        $activePage = $user->activePage();
        if ($activePage == null) {
            // handle errors
        }

        try {
            $response = Http::get($activePage->page_url);
        } catch (Exception $e) {
            // handle errors
            return redirect('/')->withErrors(['msg' => 'There is something wrong with this portfolio.']);
        }
        if (!$response->successful()) {
            // handle errors
        }
        //dd($response->body());
        $markdown_portfolio = $response->body();
        return view('users.show', compact('user', 'markdown_portfolio'));
    }
}
