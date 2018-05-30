<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Rating;
use App\Http\Resources\RatingResource;
use App\Models\User;

class ProjectRatingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tester($projectId, $testerId)
    {
        $project = Project::findOrFail($projectId);
        $tester = User::findOrFail($testerId);
        if (!$project->testers->contains($tester)) {
            return abort(422, 'Tester does not exist for this project');
        }
        $rated = $tester->ratings()->whereHas('subjectProject', function ($q) use ($projectId) {
            $q->where('id', $projectId);
        })->first();
        if ($rated) {
            return abort(422, 'Tester has already been rated for this project');
        }
        if (!(auth()->user()->isAdmin() || $project->publisher->id === auth()->user()->id)) {
            abort(403, 'You can not rate for this tester for this project');
        }
        $rating = $tester->giveRatings(request('ratings'))->forProject($project);
        return new RatingResource($rating);
    }

    public function ratedTesters($projectId)
    {
        $project = Project::findOrFail($projectId);
        $rated = Rating::whereHas('subjectProject', function ($q) use ($projectId) {
            $q->where('id', $projectId);
        })->with('rating_entity')->get();
        return RatingResource::collection($rated->map(function ($r) {
            $r->tester_id = $r->rating_entity->id;
            return $r;
        }));
    }
}
