<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectQuestionTesterAnswer extends Model
{
    use SoftDeletes;

    protected $fillable = ['id', 'project_question_id', 'tester_id', 'answer'];
}
