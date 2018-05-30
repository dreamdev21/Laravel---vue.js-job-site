<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $append = ['subjectProject', 'subjectTester'];

    protected $hidden = ['rating_entity_id', 'rating_entity_type', 'rating_for_entity_id', 'rating_for_entity_type', 'rating_giver'];

    protected $casts = [
        'rating' => 'float',
    ];

    public function rating_entity()
    {
        return $this->morphTo();
    }

    public function subjectProject()
    {
        return $this->morphedByMany(Project::class, 'ratable');
    }

    public function subjectTester()
    {
        return $this->morphedByMany(User::class, 'ratable');
    }

    public function ratingGiver()
    {
        return $this->belongsTo(User::class, 'rating_giver');
    }
}
