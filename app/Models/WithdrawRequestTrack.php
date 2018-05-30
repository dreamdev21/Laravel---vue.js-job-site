<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawRequestTrack extends Model
{
    // never allow to fill anything in mass.
    protected $fillable = [];

    public function withdrawal()
    {
        return $this->belongsTo(Withdrawal::class, 'withdrawal_id');
    }

    public function tester()
    {
        return $this->withdrawal->tester;
    }
}
