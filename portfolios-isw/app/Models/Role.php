<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public $guarded = [];
    public function userAmount()
    {
        return User::where('role_id', $this->role_id)->get()->count();
    }

    public function linkPath()
    {
        return "/admin/roles/" . $this->id;
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
