<?php

namespace App\Http\Controllers;

use App\Models\Handles;
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
    public function change_colors() {
        $user = auth()->user();

        // business logic here
        request()->validate([
            'background_color' => ['nullable', 'string', 'max:50'],
            'foreground_color' => ['nullable', 'string', 'max:50'],
        ]);

        $user->background_color = request()['background_color'];
        $user->foreground_color = request()['foreground_color'];
        $user->save();
        return redirect('/profile/customize')->with('result', 'Saved colors!');
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

    public function update_handle($handleName) {
        $user = User::findOrFail(auth()->user()->id);
        $handles = Handles::findOrFail($user->handles->id);

        if ($handleName == 'website') {
            $handles['website'] = request()['handle'];
        } else {
            $handles[$handleName . '_handle'] = request()['handle'];
        }

        $handles->save();

        return redirect('/profile/customize')->with('result', 'Updated successfully.'); // or something with 'Saved'
    }
}
