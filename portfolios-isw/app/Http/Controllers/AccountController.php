<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function index() {
        return view('account.index');
    }
    public function validator(array $data)
    {
        return Validator::make($data, [ // idk just copied
            'page_url' => ['required', 'string'],
        ]);
    }
    public function store() {
    }


}
