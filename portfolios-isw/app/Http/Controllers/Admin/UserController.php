<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        // delete notification should be received here
        $users = User::all();
        return view('admin.users.overview', ['users' => $users]);
    }
    public function show($userId)
    {
        $user = User::findOrFail($userId);
        return view('admin.users.show', ['user' => $user]);
    }
    public function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'min:3', 'max:50', 'unique:users'],
            'fname' => ['required', 'string', 'min:3', 'max:50'],
            'lname' => ['required', 'string', 'min:3', 'max:50'],
            'email_address' => ['required', 'min:1', 'unique:users'],
            'role_id' => ['required', 'min:1'],
            'password' => ['required', 'min:1'],
        ]);
    }
    public function create()
    {
        $roles = \App\Models\Role::all();
        return view('admin.users.create', compact('roles'));
    }
    public function store()
    {
        $data = request()->all();
        $this->validator($data)->validate();
        $data['password'] = Hash::make($data['password']);

        $newUser = User::create($data);

        Page::create(['user_id' => $newUser->id, 'page_url' => '/', 'status' => false]);

        return redirect($newUser->linkPath());
    }
    public function edit($userId)
    {
        $user = User::findOrFail($userId);
        return view('admin.users.edit', compact($user));
    }
    public function update($userId)
    {
        $this->validator(request()->all())->validate();
        $user = User::findOrFail($userId);
        $user->username = request()['username'];
        $user->fname = request()['fname'];
        $user->lname = request()['lname'];
        $user->email_address = request()['email_address'];
        $user->role_id = request()['role_id'];
        $user->password = Hash::make(request()['password']);
        $user->save();
        return redirect('/users/' . $userId);
    }
    public function destroy($userId)
    {
        // pages have to be deleted first
        User::findOrFail($userId)->delete();
        return redirect('/users/');
    }
}
