<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class TesterEarning extends Model
{
    use SoftDeletes;

    protected $hidden = ['project_id', 'tester_id'];

    protected $appends = ['name'];

    protected $fillable = [];

    protected $with = ['project'];

    protected $casts = [
        'amount' => 'float',
        'balance_after' => 'float',
        'is_bonus' => 'boolean'
    ];

    public function getNameAttribute()
    {
        return $this->project->name;
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function tester()
    {
        return $this->belongsTo(User::class, 'tester_id');
    }
}
