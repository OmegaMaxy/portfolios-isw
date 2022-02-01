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
        'background_image',
        'background_color',
        'background_color',
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
        if (empty($this->profile_picture)) return '/img/default_pf.png';
        // https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUHNoKb6n8cRAjyputJ9vn4OPdujzLJr52OQ&usqp=CAU
        return '/storage/'.$this->profile_picture;
    }
    public function handles() {
        return $this->hasOne(Handles::class);
    }
    public function getHandles() {
        return [
            'twitter' => [
                'handle' => '@'.$this->handles['twitter_handle'],
                'url' => 'https://twitter.com/' . $this->handles['twitter_handle'],
                'icon' => 'bi-twitter',
                'style' => 'background: #1DA1F2;border-color: #1DA1F2;border-radius: 4px;',
            ],
            'linkedin' => [
                'handle' => '@' . $this->handles['linkedin_handle'],
                'url' => ' https://www.linkedin.com/in/' . $this->handles['linkedin_handle'],
                'icon' => 'bi-linkedin',
                'style' => 'background: #2867B2;border-color: #3490dc;border-radius: 4px;',
            ],
            'spotify' => [
                'handle' => '@' . $this->handles['spotify_handle'],
                'url' => 'https://open.spotify.com/user/' . $this->handles['spotify_handle'],
                'icon' => 'bi-spotify',
                'style' => 'background: #1DB954;border-color: #1DB954;border-radius: 4px;',
            ],
            'discord' => [
                'handle' => $this->handles['discord_handle'],
                'url' => '#',
                'icon' => 'bi-discord',
                'style' => 'background: #7289DA;border-color: #7289DA;border-radius: 4px;',
            ],
            'github' => [
                'handle' => '@' . $this->handles['github_handle'],
                'url' => 'https://github.com/' . $this->handles['github_handle'],
                'icon' => 'bi-github',
                'style' => 'background: #161b22;border-color: #3490dc;border-radius: 4px;',
            ],
            'website' => [
                'handle' => $this->handles['website'],
                'url' => 'https://'.$this->handles['website'],
                'icon' => 'css-website',
                'style' => 'background: #161b22;border-color: #3490dc;border-radius: 4px;',
            ],
        ];
    }
}
