<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    use HasFactory;

    protected $guarded = [];
    /**
     * Checks whether invite is usable.
     *
     * return boolean if uses_left is not 0 and valid_till date is in the future
     */
    public function usable() {
        return $this->uses_left != 0 && Carbon::parse($this->valid_till)->gt(Carbon::now());
    }

    /**
     * Subtracts given amount from invite's uses.
     *
     * @param integer $amount
     */
    public function subtractUse($amount) {
        $this->uses_left = $this->uses_left - $amount;
        $this->save();
    }

    public function linkPath() {
        return '/invite/'.$this->hash;
    }
}
