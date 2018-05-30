<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    use SoftDeletes;

    protected $fillable = ['os','ram','processor','gpu_memory','gpu_model'];
}
