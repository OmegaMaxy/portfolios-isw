<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use \App\Models\Role;
use \App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RoleController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        // delete notification should be received here
        $roles = Role::all()->sortBy('role_number');
        return view('admin.roles.overview', ['roles' => $roles]);
    }
    public function show($roleId)
    {
        $role = Role::findOrFail($roleId);
        return view('admin.roles.show', ['role' => $role]);
    }
    public function validator(array $data, bool $isUpdate)
    {
        if ($isUpdate) {
            return Validator::make($data, [
                'name' => ['required', 'string', 'min:3', 'max:50', Rule::unique('roles')->ignore($data['id'])],
                'role_number' => ['required', 'min:1', Rule::unique('roles')->ignore($data['id'])],
                'description' => ['nullable', 'max: 255'],
                'color' => ['required', 'max: 255'],
            ]);
        } else {
            return Validator::make($data, [
                'name' => ['required', 'string', 'min:3', 'max:50', 'unique:roles'],
                'role_number' => ['required', 'min:1', 'unique:roles'],
                'description' => ['nullable', 'max: 255'],
                'color' => ['required', 'max: 255'],
            ]);
        }
    }
    public function create()
    {
        // TODO: only select one with highest role number
        $role = DB::table('roles')->latest('created_at')->first();
        $role_number = ($role == null) ? 0 : $role->role_number;
        return view('admin.roles.create', ['last_role_number' => $role_number]);
    }
    public function store()
    {
        $data = request()->all();
        $data = $this->validator($data, false)->validate();
        Role::create($data);
        return redirect('/admin/roles');
    }
    public function edit($roleId)
    {
        $role = Role::findOrFail($roleId);
        return view('admin.roles.edit', compact($role));
    }
    public function update($roleId)
    {

        $data = request()->all();
        $data['id'] = $roleId;

        $role = Role::findOrFail($roleId);
        if ($role->role_number == 1) $data['role_number'] = 1;

        $this->validator($data, true)->validate();

        $role->name = request()['name'];
        $role->role_number = ($role->role_number == 1) ? 1 : request()['role_number'];
        $role->color = request()['color'];
        $role->description = request()['description'];
        $role->save();
        return redirect('/admin/roles/' . $roleId);
    }
    public function destroy($roleId)
    {
        $usersWithThisRole = User::where('role_id', $roleId)->get();
        if ($usersWithThisRole->isEmpty()) {
            Role::findOrFail($roleId)->delete();
            return redirect('/admin/roles/');
        } else {
            return redirect('/admin/roles/' . $roleId)->withErrors(['msg' => 'Cannot delete role. There are still users with this role.']);;
        }
    }
}
