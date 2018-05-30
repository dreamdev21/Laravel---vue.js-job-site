<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStatus\HasStatuses;

class Invoice extends Model
{
    use SoftDeletes, HasStatuses;

    protected $appends = ['is_paid', 'paid_on', 'transaction_id'];

    protected $fillable = [
        'name'
    ];

    protected $hidden = ['entity_id', 'entity_type', 'deleted_at'];

    protected $casts = [
        'amount' => 'float',
        'tax' => 'float',
        'due_on' => 'date',
        'is_paid' => 'boolean'
    ];

    public function entity()
    {
        return $this->morphTo();
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getPaymentAttribute()
    {
        return $this->payments()->first();
    }

    public function getIsPaidAttribute()
    {
        return optional($this->payment)->is_paid;
    }

    public function getPaidOnAttribute()
    {
        return optional($this->payment)->paid_on;
    }

    public function getTransactionIdAttribute()
    {
        if ($this->is_paid) {
            return $this->payment->transaction_id;
        }
        return null;
    }

    public function getTotalAttribute()
    {
        return $this->amount + $this->tax;
    }
}
