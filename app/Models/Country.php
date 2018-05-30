<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'status'];

    /**
     * Always capitalize the first letter
     */
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }
}
