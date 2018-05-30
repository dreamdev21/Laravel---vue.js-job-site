<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    //
    use SoftDeletes;

    const PERCENTAGE_DISCOUNT = 'percentage';

    const AMOUNT_DISCOUNT = 'amount';

    protected $guarded = ['id'];

    protected $casts = [
        'discount_type' => 'integer',
        'first_project_per_tester_charge' => 'float',
        'regular_per_tester_charge' => 'float',
        'discount_after_number_of_tester' => 'integer',
        'discount_amount' => 'float',
        'is_default' => 'boolean'
    ];

    public static function defaultPackage()
    {
        return (new static)->newQuery()->where('is_default', true)->first();
    }

    /**
     * Always capitalize the first letter
     */
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function hasDiscount()
    {
        return $this->discount_after_number_of_tester > 0 && !is_null($this->discount_type);
    }

    public function hasDiscountInPercentage()
    {
        if ($this->attributes['discount_type'] === 1) {
            return true;
        }
        return false;
    }

    public function calculateCostPerTester($testers = 0, $isFirstProject = false)
    {
        if ($testers === 0) {
            return;
        }
        $baseCost = $isFirstProject ? $this->first_project_per_tester_charge : $this->regular_per_tester_charge;
        if (!$this->hasDiscount()) {
            return $baseCost;
        }
        $discountAmount = 0;
        if ($testers > $this->discount_after_number_of_tester) {
            $discountAmount = $this->hasDiscountInPercentage() ? $baseCost * ($this->discount_amount / 100) : $this->discount_amount;
        }
        return $baseCost - $discountAmount;
    }
}
