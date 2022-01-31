<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function index()
    {
        $pages = auth()->user()->pages;
        return view('account.pages', compact('pages'));
    }
    public function validator(array $data)
    {
        return Validator::make($data, [
            'page_url' => ['required', 'string'],
        ]);
    }
    public function store()
    {
        $data = request()->all();

        $this->validator($data)->validate();
        $data['user_id'] = auth()->user()->id;
        $data['status'] = array_key_exists('status', $data);

        // only one page can be active
        $results = auth()->user()->pages->where('status', 1);
        if ($results->count() > 0) return redirect('/account')->withErrors(['msg' => 'Only one page can be active!']);
        \App\Models\Page::create($data);
        return redirect('/account');
    }
    public function destroy($pageId)
    {
        $page = \App\Models\Page::findOrFail($pageId);
        if ($page->user->id != auth()->user()->id) {
            redirect('/account')->withErrors(['msg' => 'You are not authorized to delete that.']);
        }

        $page->delete();
        return redirect('/account'); //->withSomething(['msg' => 'Page successfully deleted.'])
    }
}
