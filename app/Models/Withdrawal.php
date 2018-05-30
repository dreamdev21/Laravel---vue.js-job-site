<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStatus\HasStatuses;
use App\TheBetaPlan\Traits\HasInvoice;

class Withdrawal extends Model
{
    use SoftDeletes, HasStatuses, HasInvoice;

    protected $hidden = ['tester_id'];

    protected $appends = ['name'];

    protected $fillable = [];

    protected $casts = [
        'amount' => 'float',
        'balance_after' => 'float',
        'is_paid' => 'boolean'
    ];

    public function getNameAttribute()
    {
        return $this->note;
    }

    public function tester()
    {
        return $this->belongsTo(User::class, 'tester_id');
    }

    public function track()
    {
        return $this->hasOne(WithdrawRequestTrack::class);
    }

    public function getInvoiceCustomerId()
    {
        return $this->tester->id;
    }
}
