<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'invite_hash' => ['required', 'string'],
            'username' => ['required', 'string', 'min:3', 'max:50', 'unique:users'],
            'fname' => ['required', 'string', 'min:2', 'max:50'],
            'lname' => ['required', 'string', 'min:2', 'max:100'],
            'password' => ['required','string', 'min:8', 'confirmed']
        ], [
            'invite_hash.required' => 'Sorry, you need an invite link to register!',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $invite = \App\Models\Invite::where('hash', $data['invite_hash'])->get()->first();
        if ($invite == null || !$invite->usable()) return redirect('/register')->withErrors(['msg' => 'Invite link is not valid, or cannot be used anymore.']);
        $invite->subtractUse(1);

        $role = DB::table('roles')->latest('created_at')->first();
        if ($role == null || $role->role_number == 1) return redirect('/register')->withErrors(['msg' => 'Signup failed. Administrator has not finished setting up this application. Please contact your administrator for furthur instructions.']);
        $lowest_role = $role->id;
        return User::create([
            'username' => $data['username'],
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'role_id' => $lowest_role,
            'password' => Hash::make($data['password']),
        ]);
    }
}
