<?php

namespace App\Models;

use Spatie\Activitylog\Models\Activity;

class ActivityLog extends Activity
{
  public function activeUser()
  {
    return $this->belongsTo(User::class, 'causer_id');
  }
  public function publisherProject()
  {
    return $this->belongsTo(Project::class, 'subject_id');
  }
}
