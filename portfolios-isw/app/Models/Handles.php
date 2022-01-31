<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Handles extends Model
{
    use HasFactory;
    protected $table = 'handles';

    public function user() {
        return $this->belongsTo(User::class, 'id');
    }
}
