<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $handles = auth()->user()->handles;
        if ($handles == null) {
            $handles = [
                'twitter_handle' => '',
                'linkedin_handle' => '',
                'spotify_handle' => '',
                'discord_handle' => '',
                'github_handle' => '',
                'website' => '',
            ];
        }
        return view('profile.customize', compact('handles'));
    }
    public function validator(array $data)
    {
        return Validator::make($data, [
            'page_url' => ['required', 'string'],
        ]);
    }
    public function store()
    {
    }
    public function delete_profile_picture()
    {

        $user = User::findOrFail(auth()->user()->id);

        Storage::delete('public/' . $user->profile_picture);

        $user->profile_picture = '';
        $user->save();

        return redirect('/profile/customize');
    }

    public function upload_profile_picture()
    {
        request()->validate([
            'pf' => 'required|max:8192'
        ]);

        if (request()->hasFile('pf')) {

            $user = auth()->user();
            if ($user->profile_picture != '') {
                Storage::delete('public/' . $user->profile_picture);
            }

            $filename = sha1(auth()->user()->id . time()) . '.png';
            request()->file('pf')->storeAs('public/profile_pictures', $filename);


            $user->profile_picture = 'profile_pictures/' . $filename;
            $user->save();
        }
        return redirect('/profile/customize');
    }
    public function change_background_color() {
        $user = auth()->user();

        // business logic here
        request()->validate([
            'background_color' => ['required', 'string', 'max:50'],
        ]);

        $user->background_color = request()['background_color'];
        $user->save();
        return redirect('/profile/customize')->with('a', 'a');
    }

    public function change_background_image()
    {
        $user = auth()->user();

        // business logic here
        request()->validate([
            'background_color' => ['required', 'string', 'max:50'],
        ]);

        $user->background_color = request()['background_color'];
        $user->save();
        return redirect('/profile/customize')->with('a', 'a');
    }
}
