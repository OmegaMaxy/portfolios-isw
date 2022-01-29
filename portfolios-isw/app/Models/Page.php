<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'page_url',
        'status',
    ];

    public function linkPath()
    {
        return "/roles/" . $this->roleId;
    }
    public function statusToText()
    {
        return ($this->status) ? "Online" : "Offline";
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function page_url_html()
    {
        return "<a href='" . $this->page_url . "' target='blank'>" . $this->page_url . "</a>";
    }
}
