<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ProjectQuestionTesterAnswer;

class ProjectQuestion extends Model
{
    use SoftDeletes;
    protected $table = 'project_questions';
    protected $fillable = ['question', 'project_id'];

    public function projectQuestionTesterAnswers(){
        return $this->hasOne(ProjectQuestionTesterAnswer::class);
    }
}
