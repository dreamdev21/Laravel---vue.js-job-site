<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectTesterResource;
use App\Models\Status;
use App\Models\Project;
use App\Models\ProjectTester;
use App\Models\User;
use Auth;

class TestController extends Controller
{
    /**
     * Fetch User data which are required for test project
     *
     * @param id Test Project id
     *
     */
    public function testUser($id)
    {
        $projectTester = ProjectTester::where([
            'tester_id' => Auth::user()->id,
            'project_id' => $id
        ])->with(['issues' => function ($query) {
            $query->with(['issueType']);
        }])->first();
        if ($projectTester) {
            $projectTester->latest_status = $projectTester->latestStatus() ? $projectTester->latestStatus()->name : '';
            $projectTester->all_status = $projectTester->latestStatus() ? $projectTester->statuses->pluck('name')->toArray() : [];

            if ($projectTester->issues) {
                $groupedIssues = [];
                collect($projectTester->issues)->map(function ($issue, $key) use (&$groupedIssues) {
                    if (isset($issue->issueType)) {
                        $groupedIssues[strtolower($issue->issueType->name)][] = $issue->description;
                    }
                    return true;
                });
                $projectTester['groupedIssues'] = $groupedIssues;
            }
            return new ProjectTesterResource($projectTester);
        }
        return response()->json([]);
    }
    /**
     * Update test project status for tester
     *
     * @param id  Test project id ( is_test_project = 1)
     *
     */
    public function updateTestStatus(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        if (empty($project)) {
            return (['success' => false]);
        }

        $projectTester = ProjectTester::where([
            'tester_id' => Auth::user()->id,
            'project_id' => $project->id
        ])->first();
        if (empty($projectTester)) {
            $projectTester = ProjectTester::create([
                'tester_id' => Auth::user()->id,
                'project_id' => $project->id
            ]);
        }
        /** Assign status to pivot table */
        $aStatus = $projectTester->statuses->pluck('name')->toArray(); // all status related to this ProjectTester
        $cStatus = Status::getStatusConstant($request->input('test_status')); // dynamic status constant
        if (!in_array($cStatus, $aStatus)) {
            $projectTester->setStatus($cStatus);
            activity()
              ->inLog("publisher-project")
              ->causedBy(auth()->user())
              ->performedOn($project)
              ->log($cStatus);
        }
        return (['success' => true]);
    }

    public function changeTestStatus($id)
    {
        $projectTester = ProjectTester::findOrFail($id);
        $status = Status::getStatusConstant(request('status'));
        $projectTester->setStatus($status);
        $projectTester->load(['project', 'tester', 'statuses']);
        if ($status === Status::TEST_PASSED) {
            $tester = $projectTester->tester;
            $tester->setStatus(Status::READY_FOR_TEST);
        }
        return new ProjectTesterResource($projectTester);
    }

    public function testStatus($id){
        $projectTester = ProjectTester::findOrFail($id);
        return response()->json(['status' => $projectTester ? $projectTester->latestStatus() : false ]);
    }

    public function moderateProjects()
    {
        $projectTester = ProjectTester::with(['project.devices', 'project.projectType', 'tester', 'statuses'])
            ->currentStatus(Status::SUBMITTED)
            ->whereHas('project', function($query){
                $query->where('deleted_at', NULL);
            })->whereHas('tester', function($query){
                $query->where('deleted_at', NULL);
            })->orderBy('created_at', 'desc')->get();
        return ProjectTesterResource::collection($projectTester);
    }
    public function isTestProjectAccepted(){
        $aProjectTestersDetails = ProjectTester::where('tester_id',Auth::user()->id)->get();
        return ProjectTesterResource::collection($aProjectTestersDetails);
    }
}
