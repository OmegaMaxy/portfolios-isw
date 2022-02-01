<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public $guarded = [];

    const DEFAULT_COLOR = '#3490dc';

    public function userAmount()
    {
        return $this->users()->count();
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
