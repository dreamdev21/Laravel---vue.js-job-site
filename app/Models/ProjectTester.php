<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStatus\HasStatuses;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
use App\Models\Status;

class ProjectTester extends Pivot implements HasMedia
{
    use SoftDeletes, HasStatuses, HasMediaTrait;

    protected $table = "project_testers";

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function tester()
    {
        return $this->belongsTo(User::class, 'tester_id')->withTrashed();
    }

    public function status()
    {
        return $this->hasMany(Status::class, 'model_id');
    }

    public function issues()
    {
        return $this->hasMany(ProjectTestersIssues::class, 'project_tester_id');
    }
}
