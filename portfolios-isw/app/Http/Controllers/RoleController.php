<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Role;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
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
        $role = Role::all()->sortDesc()[0];
        return view('roles.create', ['last_role' => $role]);
    }
    public function store()
    {
        $data = request()->all();
        $this->validator($data)->validate();
        return redirect('/roles/' . Role::create($data)->id);
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
        Role::findOrFail($roleId)->delete();
        return redirect('/roles/');
    }
}
