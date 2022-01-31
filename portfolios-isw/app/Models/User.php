<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'username',
        'fname',
        'lname',
        'role_id',
        'email_address',
        'password',
        'profile_picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function linkPath()
    {
        return "/users/" . $this->id;
    }
    public function linkPathAdmin()
    {
        return "/admin/users/" . $this->id;
    }
    public function fullname()
    {
        return ucfirst($this->fname) . " " . ucfirst($this->lname);
    }
    public function pages()
    {
        return $this->hasMany(Page::class);
    }
    public function activePage()
    {
        $activePage = Page::select('*')
            //->with('users')
            ->join('users', function ($join) {
                $join->on('pages.user_id', '=', 'users.id');
            })
            ->where('user_id', $this->id)
            ->where('status', '1')
            ->first(); // first() might give an error
        return $activePage;
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function pf() {
        //dd($this->profile_picture);
        return '/storage/'.$this->profile_picture;
    }
    public function handles() {
        return $this->hasOne(Handles::class, 'user_id');
    }
}
