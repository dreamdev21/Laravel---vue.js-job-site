<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectTestersIssues extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function issueType()
    {
        return $this->belongsTo(IssueTypes::class);
    }
}
