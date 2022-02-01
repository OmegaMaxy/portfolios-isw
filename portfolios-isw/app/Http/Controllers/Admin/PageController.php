<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends \App\Http\Controllers\Controller
{
    // when entering a new url change isFirstTime value to false, and ENABLE the status ++ ??

    public function show($userId)
    {
        $user = \App\Models\User::findOrFail($userId);
        $page = $user->activePage();
        return view('admin.pages.show', ['page' => $page]);
    }
    public function create_with_userid($userId)
    {
        return view('admin.pages.create_with_userid', ['userId' => $userId]);
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
        return redirect('/admin/users/' . $data['user_id']);
    }
    public function change_status($userId) {
        $page = Page::findOrFail(request()->page_id);
        if ( $userId != $page->user->id) {
            // not authorized aka page doesnt belong to user
            // remember this is an admin controller
            return redirect('/admin/users/' . $userId)->withErrors(['msg' => 'Operation failed. That page does not belong to that user.']);
        }
        if ( auth()->user()->activePage() != null && request()->status == 1 ) return redirect('/admin/users/' . $userId)->withErrors(['msg' => 'Operation failed. Only one page can be enabled.']);
        $page->status = (request()->status == 1) ? true : false;
        $page->save();
        return redirect('/admin/users/' . $userId);
    }
}
