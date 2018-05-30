<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use SoftDeletes;

    protected $hidden = ['user_id'];

    protected $fillable = [];

    protected $casts = [
        'available_earnings' => 'float',
        'total_paid_earnings' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getBalance()
    {
        return $this->available_earnings;
    }

    public function add($amount)
    {
        $this->available_earnings += $amount;
        $this->save();
        return $this;
    }

    public function deduct($amount)
    {
        $this->available_earnings -= $amount;
        $this->save();
        return $this;
    }
}
