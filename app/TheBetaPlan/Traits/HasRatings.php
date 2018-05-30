<?php

namespace App\TheBetaPlan\Traits;

use App\Models\Rating;
use Ramsey\Uuid\Uuid;

trait HasRatings
{
    protected $currentRating = null;

    public function ratings()
    {
        return $this->morphMany(Rating::class, 'rating_entity');
    }

    public function giveRatings($score = 0, $suggestion = null, $collection = null)
    {
        $rating = new Rating();
        $rating->rating_giver = auth()->user()->id;
        $rating->score = $score;
        $rating->suggestion = $suggestion;
        $rating->collection_name = $collection;
        $this->ratings()->save($rating);
        $this->currentRating = $rating;
        return $this;
    }

    public function forTester($tester)
    {
        $this->currentRating->subjectTester()->save($tester);
        return $this->currentRating;
    }

    public function forProject($project)
    {
        $this->currentRating->subjectProject()->save($project);
        return $this->currentRating;
    }

    public function getRatingsAttribute()
    {
        return $this->ratings()->avg('score');
    }
}
