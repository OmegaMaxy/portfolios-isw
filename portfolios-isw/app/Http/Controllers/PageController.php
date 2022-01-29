<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    // when entering a new url change isFirstTime value to false, and ENABLE the status ++ ??

    public function show($userId)
    {
        $user = \App\Models\User::findOrFail($userId);
        $page = $user->activePage();
        return view('pages.show', ['page' => $page]);
    }
    public function create_with_userid($userId)
    {
        return view('pages.create_with_userid', ['userId' => $userId]);
    }
    public function validator(array $data)
    {
        return Validator::make($data, [
            'user_id' => ['required', 'integer'],
            'page_url' => ['required', 'string'],
            'status' => ['required', 'boolean']
        ]);
    }
    public function store()
    {
        $data = request()->all();
        $this->validator($data)->validate();

        \App\Models\Page::create($data);
        return redirect('/users/' . $data['user_id']);
    }
}
