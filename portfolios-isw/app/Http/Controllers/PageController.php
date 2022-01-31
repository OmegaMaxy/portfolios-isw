<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function index()
    {
        $warnings = [];
        $pages = auth()->user()->pages;
        if ($pages->filter(function($page) { return $page->status == true; })->values()->count() == 0) {
            $warnings[] = 'Warning, You have no active page!';
        }
        return view('profile.pages', compact('pages', 'warnings'));
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
        if ($data['status'] == true && $results->count() > 0) return redirect('/profile/pages')->withErrors(['msg' => 'Only one page can be active!']);
        // TODO: test here if the url can be reached etc. add [Resovlable] badge to record

        \App\Models\Page::create($data);
        return redirect('/profile/pages');
    }
    public function destroy($pageId)
    {
        $page = \App\Models\Page::findOrFail($pageId);
        if ($page->user->id != auth()->user()->id) {
            redirect('/profile/pages')->withErrors(['msg' => 'Operation failed. You are not authorized to delete that.']);
        }

        $page->delete();
        return redirect('/profile/pages'); //->withSomething(['msg' => 'Page successfully deleted.'])
    }
    public function change_status() {
        $userId = auth()->user()->id;
        $page = Page::findOrFail(request()->page_id);
        if ($userId != $page->user->id) {
            return redirect('/profile/pages')->withErrors(['msg' => 'Operation failed. That page does not belong to you.']);
        }
        if (auth()->user()->activePage() != null && request()->status == 1) return redirect('/profile/pages')->withErrors(['msg' => 'Operation failed. Only one page can be enabled.']);
        $page->status = (request()->status == 1) ? true : false;
        $page->save();
        return redirect('/profile/pages');
    }
}
