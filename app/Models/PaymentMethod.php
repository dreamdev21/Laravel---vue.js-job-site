<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $guarded = ['id'];

    protected $hidden = ['deleted_at', 'owner_id'];

    protected $casts = [
        'account_data' => 'array',
        'is_default' => 'boolean'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
