<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use \App\Models\Role;
use \App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        // delete notification should be received here
        $roles = Role::all()->sortBy('role_number');
        return view('roles.overview', ['roles' => $roles]);
    }
    public function show($roleId)
    {
        $role = Role::findOrFail($roleId);
        return view('roles.show', ['role' => $role]);
    }
    public function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'min:3', 'max:50', 'unique:roles'],
            'role_number' => ['required', 'min:1', 'unique:roles'],
            'description' => ['nullable', 'max: 255'],
        ]);
    }
    public function create()
    {
        // TODO: only select one with highest role number
        $role = DB::table('roles')->latest('created_at')->first();
        $role_number = ($role == null) ? 0 : $role->role_number;
        return view('roles.create', ['last_role_number' => $role_number]);
    }
    public function store()
    {
        $data = request()->all();
        $data = $this->validator($data)->validate();
        Role::create($data);
        return redirect('/roles');
    }
    public function edit($roleId)
    {
        $role = Role::findOrFail($roleId);
        return view('roles.edit', compact($role));
    }
    public function update($roleId)
    {
        $this->validator(request()->all())->validate();
        $role = Role::findOrFail($roleId);
        $role->name = request()['name'];
        $role->role_number = request()['role_number'];
        $role->description = request()['description'];
        $role->save();
        return redirect('/roles/' . $roleId);
    }
    public function destroy($roleId)
    {
        $usersWithThisRole = User::where('role_id', $roleId)->get();
        if ($usersWithThisRole->isEmpty()) {
            Role::findOrFail($roleId)->delete();
            return redirect('/roles/');
        } else {
            return redirect('/roles/' . $roleId)->withErrors(['msg' => 'Cannot delete role. There are still users with this role.']);;
        }
    }
}
