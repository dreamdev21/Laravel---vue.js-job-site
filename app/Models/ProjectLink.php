<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectLink extends Model
{
    protected $table = 'project_links';
    protected $fillable = ['project_id', 'title', 'link'];
}
