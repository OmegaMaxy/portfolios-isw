<?php

namespace App\Http\Controllers\Admin;

use App\Models\Invite;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InviteController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        $invites = Invite::all();
        return view('admin.invites.index', compact('invites'));
    }
    public function validator(array $data)
    {
        return Validator::make($data, [
            'valid_till' => ['required', 'date'],
            'max_uses' => ['nullable', 'integer']
        ]);
    }
    public function store()
    {
        $data = request()->all();
        $this->validator($data)->validate();

        $data['hash'] = sha1(time());
        if (empty($data['max_uses'])) {
            $data['uses_left'] = null;
            $data['max_uses'] = null;
        } else {
            $data['uses_left'] = $data['max_uses'];
        }


        \App\Models\Invite::create($data);
        return redirect('/admin/invites/');
    }
    public function destroy($inviteId)
    {
        \App\Models\Invite::destroy($inviteId);
        return redirect('/admin/invites/');
    }
}
