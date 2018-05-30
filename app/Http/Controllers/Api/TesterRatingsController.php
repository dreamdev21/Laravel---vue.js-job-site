<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Rating;
use App\Models\ProjectTester;
use App\Models\ProjectQuestion;
use App\Http\Resources\RatingResource;
use App\Http\Resources\ProjectQuestionResource;
use App\Models\User;
use Illuminate\Http\Request;

class TesterRatingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function project(Request $request,$testerId, $projectId)
    {
        $aRequest = collect($request->all())->keyBy('title');
        $project = Project::findOrFail($projectId);
        $tester = User::findOrFail($testerId);
        if (!$project->testers->contains($tester)) {
            return abort(422, 'Tester does not exist for this project');
        }
        if (!(auth()->user()->isAdmin() || intval($testerId) === auth()->user()->id)) {
            abort(403, 'You can not rate for this tester for this project');
        }
        $rated = $project->ratings()->whereHas('subjectTester', function ($q) use ($testerId) {
            $q->where('id', $testerId);
        })->get();
        if($rated){ $rated = $rated->keyBy('collection_name'); }
        $ratings = $aRequest->map(function ($section, $sectionKey) use ($rated, $project, $tester) {
            // $ratedItem = $rated->first(function ($item) use ($collectionName) {
            //     return $item->collection_name === $collectionName;
            // });
            collect($section['sub_points'])->map(function($collection) use ($rated, $sectionKey, $project, $tester){
                $collectionName = $sectionKey.'@'.str_replace(' ', '_', strtolower($collection['title']));
                if($rated->has($collectionName)){
                    $ratedItem= $rated[$collectionName];
                    $ratedItem->score = $collection['rating']['score'];
                    $ratedItem->suggestion = $collection['rating']['suggestion'];
                    $ratedItem->save();
                    return $ratedItem;
                }
                if($collection['rating']['score'])
                    return $project->giveRatings($collection['rating']['score'], $collection['rating']['suggestion'], $collectionName)->forTester($tester);
            });
            // $requestData = request($collectionName);
            // if ($requestData) {
            //     if ($ratedItem) {
            //         $ratedItem->score = $requestData['score'];
            //         $ratedItem->suggestion = $requestData['suggestion'];
            //         $ratedItem->save();
            //         return $ratedItem;
            //     }
            //     return $project->giveRatings($requestData['score'], $requestData['suggestion'], $collectionName)->forTester($tester);
            // }
            return null;
        });
        if(!$ratings)
            return RatingResource::collection($ratings);
    }

    public function testerRatingsForProject($projectId, $testerId)
    {
        $project = Project::findOrFail($projectId);
        $tester = User::findOrFail($testerId);
        if (!$project->testers->contains($tester)) {
            return abort(422, 'Tester does not exist for this project');
        }
        $ratings = $project->ratings()->whereHas('subjectTester', function ($q) use ($tester) {
            $q->where('id', $tester->id);
        })->get();
        return RatingResource::collection($ratings);
    }

    public function testerInputsForProject($projectId, $testerId){
        $tester = User::findOrFail($testerId);
        $project = Project::findOrFail($projectId);
        if (!$project->testers->contains($tester)) {
            return abort(422, 'Tester does not exist for this project');
        }
        /** Tester's inputs for Questions */
        $questionAnswers = [];
        $projectQuestionAnwers = $project->with(['questions' => function($query) use ($tester){
                $query->with(['projectQuestionTesterAnswers' => function($query) use ($tester){
                    $query->where('tester_id', $tester->id );
                }]);
            }])->findOrFail($projectId);
        $aData['projectQuestionAnwers'] = $projectQuestionAnwers;
        
        /** Tester's inputs for Issues */
        $projectTester = ProjectTester::where([
            'tester_id' => $testerId,
            'project_id' => $projectId
        ])->with(['issues' => function ($query) {
            $query->with(['issueType']);
        }])->first();
        if ($projectTester->issues) {
            $groupedIssues = [];
            collect($projectTester->issues)->map(function ($issue, $key) use (&$groupedIssues) {
                if (isset($issue->issueType)) {
                    $groupedIssues[strtolower($issue->issueType->name)][] = $issue->description;
                }
                return true;
            });
            $aData['groupedIssues'] = $groupedIssues;
        }

        return $aData;
    }
}
