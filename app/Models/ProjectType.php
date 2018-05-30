<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectType extends Model
{
    const VR_GAME = 'VR Game';
    const VR_APPLICATION = 'VR Application';
    const S_VA = 'Single user VR Application';
    const S_VG = 'Single player VR Game';
    const M_VG = 'Multiplayer VR game';
    const M_VA = 'Multi user VR Application';
    use SoftDeletes;
    protected $table = 'project_types';
    protected $fillable = ['name', 'status'];
}
