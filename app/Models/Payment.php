<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    // nothing can be mass assigned for security reason.
    protected $fillable = [];

    protected $append = ['is_paid'];

    protected $casts = [
        'is_paid' => 'boolean',
        'paid_on' => 'datetime'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function payer()
    {
        return $this->belongsTo(User::class, 'payer_id');
    }
}
