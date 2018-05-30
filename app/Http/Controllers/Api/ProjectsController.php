<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Project;
use App\Http\Resources\ProjectResource;
use App\Http\Requests\ProjectRequest;
use App\Http\Requests\ProjectStoreRequest;
use App\Models\Status;
use App\Models\Role;
use App\Models\ProjectQuestion;
use App\Models\ProjectType;
use App\Models\ProjectLink;
use Auth;
use Illuminate\Validation\UnauthorizedException;
use Spatie\Activitylog\Models\Activity;
use App\Models\ActivityLog;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aProjects = [];
        $projects = Project::with([
            'publisher', 'projectType', 'devices', 'status', 'links',
            'testerProjects' => function ($query) {
                $query->with('tester');
            }
        ])
            ->where('is_test_project', (request('test', 0)) ? true : false)
            ->orderBy('created_at', 'desc')->get();
        /** Filtering data based of it's status for publisher */
        if (request('test')) {
            $aProjects = $projects;
        } else {
            if (Auth::user()->hasRole(Role::admin())) {
                $projects->map(function ($project) use (&$aProjects) {
                    $latestStatus = $project->latestStatus();
                    if (empty($latestStatus)) {
                        return true;
                    }
                    $sStatus = 'a' . str_replace(' ', '', $latestStatus->name . 'Projects');
                    $result = $project->toArray();
                    $result['testersSubmitted'] = [];
                    $project->testerProjects->map(function ($testerProject) use (&$result) {
                        if (in_array($testerProject->status, [Status::SUBMITTED])) {
                            $result['testersSubmitted'][] = $testerProject->tester;
                        }
                        return true;
                    });
                    $result['status'] = $latestStatus;
                    $aProjects[$sStatus][] = $result;
                });
            } elseif (Auth::user()->hasRole(Role::publisher())) {
                $projects->map(function ($project) use (&$aProjects) {
                    $latestStatus = $project->latestStatus();
                    if (empty($latestStatus)) {
                        return true;
                    }
                    $sStatus = 'a' . str_replace(' ', '', $latestStatus->name . 'Projects');
                    $result = $project->toArray();
                    $result['status'] = $latestStatus;
                    $aProjects[$sStatus][] = $result;
                });
            }
        }
        return $aProjects;
    }

    /*
     * Display all of projects list with publisher_id
     */
    public function publisherProjects()
    {
        $aProjects = [];
        $projects = Project::with([
            'publisher', 'projectType', 'devices', 'status', 'links',
            'testerProjects' => function ($query) {
                $query->with('tester');
            }
        ])
            ->where('publisher_id', request('publisher_id'))
            ->orderBy('created_at', 'desc')->get();
        $projects->map(function ($project) use (&$aProjects) {
            $latestStatus = $project->latestStatus();
            if (empty($latestStatus)) {
                return true;
            }
            $sStatus = 'a' . str_replace(' ', '', $latestStatus->name . 'Projects');
            $result = $project->toArray();
            $result['testersSubmitted'] = [];
            $project->testerProjects->map(function ($testerProject) use (&$result) {
                if (in_array($testerProject->status, [Status::SUBMITTED])) {
                    $result['testersSubmitted'][] = $testerProject->tester;
                }
                return true;
            });

            $result['status'] = $latestStatus;
            $aProjects[$sStatus][] = $result;
        });
        return $aProjects;
    }

    public function testerProjects()
    {
        $tProjects = [];
        $projects = Project::with('testers', 'publisher', 'projectType', 'devices', 'status', 'links')
            ->whereHas('testers', function ($query) {
                $query->where('tester_id', request('tester_id'));
            })
            ->orderBy('created_at', 'desc')->get();
        $projects->map(function ($project) use (&$tProjects) {
            $latestStatus = $project->latestStatus();
            if (empty($latestStatus)) {
                return true;
            }
            $sStatus = 'a' . str_replace(' ', '', $latestStatus->name . 'Projects');
            $result = $project->toArray();
            $result['status'] = $latestStatus;
            $tProjects[$sStatus][] = $result;
        });
        return $tProjects;
    }
    
    public function activitiesLog(){
      $user_id = auth()->user()->id;
      $publisherProject_ids = Project::where("publisher_id","=", $user_id)->pluck('id')->toArray();
      $all_activity = ActivityLog::with('activeUser', 'publisherProject')
        ->where('log_name', '=', 'publisher-project')
        ->whereIn("subject_id", $publisherProject_ids)
        ->orWhere('description', '=', 'Sign in')
        ->where('causer_id', '=', $user_id)
        ->orderBy('created_at', 'desc')
        ->limit(6)
        ->get();
//      $data['publisher_activity'] = ActivityLog::with('activeUser')
//        ->where('causer_id', '=', $user_id)
//        ->where('log_name', '=', 'publisher-project')
//        ->orderBy('created_at', 'desc')
//        ->get();
//      $data['all_activity'] = ActivityLog::with('activeUser', 'publisherProject')
//        ->where('log_name', '=', 'publisher-project')
//        ->orderBy('created_at', 'desc')
//        ->get();
      return $all_activity;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectStoreRequest $request)
    {
        $user_id = auth()->user()->id;
        if ($request->get('is_test_project')) {
            $is_test_project = true;
        } else {
            $is_test_project = false;
        }
        $project = new Project([
            'name' => $request->get('name'),
            'publisher_id' => $user_id,
            'project_type_id' => $request->get('project_type_id'),
            'start_date' => $request->get('start_date'),
            'tester_needed' => $request->get('tester_needed'),
            'end_date' => $request->get('end_date'),
            'estimate_tester_time' => $request->get('estimate_tester_time'),
            'project_description' => $request->get('project_description'),
            'notes_instruction' => $request->get('notes_instruction'),
            'is_test_project' => $is_test_project
        ]);
        $project->save();
        $project->setStatus(Status::PENDING_APPROVAL);
        $project_id = $project->id;
        $questions = $request->get('questions');
        if (isset($questions)) {
            $project->questions()->createMany(collect($questions)->map(function ($q) {
                return ['question' => $q];
            })->toArray());
        }
        if (isset($request->attachments)) {
            $project->links()->createMany(collect($request->attachments)->map(function ($l) {
                return $l;
            })->toArray());
        }
        // to attach devices with project
        if (request('devices')) {
            $project->devices()->sync(request('devices'));
        }
        $project->load(['publisher', 'projectType', 'devices']);
        if ($request->hasFile('app')) {
            $project->addMultipleMediaFromRequest(['app'])
                ->each(function ($fileAdder, $index) use ($request) {
                    $fileAdder->withCustomProperties(['description' => $request->app_description[$index]])->toMediaCollection('app');
                });
        }
        return new ProjectResource($project);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::with([
            'publisher', 'projectType', 'devices', 'status', 'links', 'questions', 'media',
            'testers' => function ($query) use ($id) {
                $query->with(['ratings' => function ($query) use ($id) {
                    $query->whereHas('subjectProject', function ($query) use ($id) {
                        $query->where('id', $id);
                    });
                }]);
            }
        ])
            ->findOrFail($id);
        return new ProjectResource($project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->fill($request->all());
        if (request('devices')) {
            $project->devices()->sync(request('devices'));
        }
        $project->save();
        if ($request->has('status')) {
            if ($request->status === 'PENDING_PAYMENT' && $project->status !== Status::PENDING_PAYMENT) {
                $this->approveProject($request, $project);
                $project->load('statuses');
                activity()
                  ->inLog("publisher-project")
                  ->causedBy(auth()->user())
                  ->performedOn($project)
                  ->log('Invoice received');
            } elseif ($request->status === 'COMPLETED') {
                $project->setStatus(Status::COMPLETED);
                activity()
                  ->inLog("publisher-project")
                  ->causedBy(auth()->user())
                  ->performedOn($project)
                  ->log('Project completed');
            }
        }
        if ($request->has('project_info_update')) {
            /** Project Questions */
            $projectQuestions = $project->questions->pluck('question')->toArray();
            if ($request->has('questions')) {
                $questions = $request->get('questions');
                $removedQuestions = array_diff($questions, $projectQuestions);
                ProjectQuestion::where('project_id', $id)->whereIn('question', $removedQuestions)->delete();
                $newQuestions = [];
                $oldQuestions = [];
                if (isset($questions)) {
                    collect($questions)->map(function ($q) use ($projectQuestions, &$newQuestions, &$oldQuestions) {
                        $oldQuestions[] = $q;
                        if (!in_array($q, $projectQuestions)) {
                            $newQuestions[] = ['question' => $q];
                        }
                        return false;
                    });
                    if ($newQuestions) {
                        $project->questions()->createMany($newQuestions);
                    }
                }
                if ($oldQuestions) {
                    $removedQuestions = array_diff($project->questions->pluck('question')->toArray(), $oldQuestions);
                    if ($removedQuestions) {
                        $project->questions()->whereIn('question', $removedQuestions)->delete();
                    }
                }
            } elseif (!$request->has('questions') && count($projectQuestions)) {
                /** All questions removed */
                $project->questions()->delete();
            }
            /** Project App */
            if ($request->has('existing_app')) {
                $aRemovedApp = $project->getMedia('app')->whereNotIn('file_name', $request->input('existing_app'));
                if (count($aRemovedApp)) {
                    $aRemovedApp->pluck('id')->each(function ($appId) use ($project) {
                        $project->deleteMedia($appId);
                    });
                }
            } elseif ($project->getMedia('app')) {
                /** All existing removed */
                $project->clearMediaCollection('app');
            }
            if ($request->hasFile('app')) {
                $project->addMultipleMediaFromRequest(['app'])
                    ->each(function ($fileAdder, $index) use ($request) {
                        $fileAdder->withCustomProperties(['description' => $request->app_description[$index]])->toMediaCollection('app');
                    });
            }
            /** Project Links */
            $project->links()->delete();
            if (isset($request->attachments)) {
                $project->links()->createMany(collect($request->attachments)->map(function ($l) {
                    return (['title' => $l['title'], 'link' => $l['link']]);
                })->toArray());
            }
        }

        $project->load(['publisher', 'projectType', 'devices']);
        return new ProjectResource($project);
    }
  
    protected function approveProject(ProjectRequest $request, Project $project)
    {
        if (!auth()->user()->isAdmin()) {
            throw new UnauthorizedException('Only admin can approve the project');
        }
        $project->cost_per_tester = $request->cost_per_tester;
        $project->allocated_tester = $request->allocated_tester;
        $project->total_cost = $request->total_cost;
        $project->applied_discount = $request->applied_discount;
        $project->per_tester_admin_decided_cost = $request->per_tester_admin_decided_cost;
        $project->setStatus(Status::PENDING_PAYMENT);
        $project->save();
        $project->createInvoice();
        activity()
            ->causedBy(auth()->user())
            ->performedOn($project)
            ->log('project has been Approved by admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return response()->json('', 204);
    }
}
