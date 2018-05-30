<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Rating;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Resources\ProjectTesterResource;
use App\Http\Requests\TesterRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\RatingResource;
use App\Models\Status;
use App\Models\Device;
use App\Models\Project;
use App\Models\IssueTypes;
use App\Models\ProjectTestersIssues;
use App\Models\ProjectTester;
use App\Models\ProjectQuestionTesterAnswer;
use Mail;
use Auth;
use App\Mail\InvitationMail;

class TestersController extends Controller
{
    public function index()
    {
        $filterableColumns = ['first_name', 'last_name', 'middle_name', 'gender', 'created_at', 'email'];
        $query = (new User)->newQuery()->with(['statuses', 'media', 'testerProjects']);
        if (request('query')) {
            $query->where(function ($q) use ($filterableColumns) {
                foreach ($filterableColumns as $c) {
                    $q->orWhere($c, 'LIKE', '%' . request('query') . '%');
                }
            });
        }
        $data = $query->whereHas('roles', function ($q) {
            $q->where('name', Role::TESTER);
        })
            ->orderBy(request('column'), request('order'))
            ->paginate(request('limit'));
        return UserResource::collection($data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TesterRequest $request)
    {
        $aInput = $request->all();
        $aInput['password'] = bcrypt($aInput['password']);
        $aInput['token'] = str_random(40);
        $aInput['token_created_at'] = date('Y-m-d H:i:s');
        $oUser = User::create($aInput);
        $oUser->assignRole(Role::tester()); //Assigning role to user
        $oUser->setStatus(Status::PENDING_ACTIVATION);
        $email = $oUser->email;
        Mail::to($email)->send(new InvitationMail($oUser));
        return new UserResource($oUser);
    }

    public function show($id)
    {
        $user = User::with(['statuses', 'devices', 'country', 'media'])->findOrFail($id);
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TesterRequest $request, $id)
    {
        $user = User::with(['status', 'devices', 'country', 'roles'])->findOrFail($id);
        $user->fill($request->all());
        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }
        /** START Assign devices to user */
        $userDevices = collect();
        if ($request->has('devices') && !empty($request->input('devices'))) {
            /** Assigning devices */
            foreach (collect($request->input('devices')) as $item) {
                $userDevices->push($item);
            }
        }
        if (count($userDevices)) {
            $user->devices()->sync($userDevices);
        }
        if ($request->has('additional_devices')) {
            $aDevice = collect($request->input('additional_devices'));
            if ($aDevice->count()) {
                $additionalDevices = $aDevice->unique()->map(function ($name) {
                    return ['status' => 'active', 'name' => $name];
                })->all();
                $user->devices()->createMany($additionalDevices);
            }
        }
        if ($request->hasFile('profile')) {
            if ($user->hasMedia('profile')) {
                $user->deleteMedia($user->getFirstMedia('profile'));
            }
            $user->addMediaFromRequest('profile')->toMediaCollection('profile');
            $user->load('media');
        }
        if ($request->has('status') && !empty($request->has('status')) && $request->status !== $user->status) {
            $user->setStatus($request->status);
        }
        if ($request->has('project_question_answers') && !empty($request->input('project_question_answers'))) {
            collect($request->input('project_question_answers'))->map(function ($project_question_ans) use ($user) {
                $projectQuestionTesterAnswer = ProjectQuestionTesterAnswer::where([
                    'tester_id' => $user->id,
                    'project_question_id' => $project_question_ans['id']
                ])->first();
                if (!empty($projectQuestionTesterAnswer)) {
                    $projectQuestionTesterAnswer->answer = $project_question_ans['answer'];
                } else {
                    $projectQuestionTesterAnswer = new ProjectQuestionTesterAnswer();
                    $projectQuestionTesterAnswer->tester_id = $user->id;
                    $projectQuestionTesterAnswer->project_question_id = $project_question_ans['id'];
                    $projectQuestionTesterAnswer->answer = $project_question_ans['answer'];
                }
                $projectQuestionTesterAnswer->save();
            });
        }
        if ($request->has('issues')) {
            $projectTester = ProjectTester::where([
                'project_id' => $request->input('project_id'),
                'tester_id' => AUth::user()->id
            ])->first();

            ProjectTestersIssues::where([
                'project_tester_id' => $projectTester->id
            ])->delete();

            collect($request->input('issues'))->map(function ($issue, $issueType) use ($projectTester) {
                $oIssueType = IssueTypes::where(['name' => $issue['name']])->first();
                if (empty($oIssueType)) {
                    return true;
                }
                if (isset($issue['bugs'])) {
                    collect($issue['bugs'])->each(function ($issueDesc) use ($oIssueType, $projectTester) {
                        if ($issueDesc['desc'] != "") {
                            $oProjectTestersIssues = ProjectTestersIssues::create([
                                'issue_type_id' => $oIssueType->id,
                                'project_tester_id' => $projectTester->id,
                                'description' => $issueDesc['desc']
                            ]);
                        }
                    });
                }
            });
        }
        $user->save();
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json('', 204);
    }

    /**
     * Tester dashboard
     */
    public function dashboard()
    {
        $isApprovedTester = ProjectTester::whereHas('status', function ($query) {
            $query->where('tester_id', Auth::user()->id);
            $query->where('name', Status::TEST_PASSED);
        })->first();
        $aData['isApprovedTester'] = $isApprovedTester ? 1 : 0;
        $aProjectTester = ProjectTester::where(['tester_id' => Auth::user()->id])
            ->with(['status', 'project' => function ($query) {
                $query->with(['projectType', 'devices', 'testers']);
                $query->withTrashed();
            }])
            ->get();
        $aProjectIds = [];
        /** Rating of project for single tester */
        $aRating = Auth::user()->ratings()->with('subjectProject')->get();
        $aRating->map(function ($rating, $key) use (&$projectRating) {
            $project = $rating->subjectProject ? $rating->subjectProject[0] : [];
            if ($project) {
                $projectRating[$project->id] = $rating->toArray();
            }
            return true;
        });

        $aProjectTester->map(function ($projectTester) use ($isApprovedTester, &$aProjectIds, &$aData, $projectRating) {
            $latestStatus = $projectTester->latestStatus();
            $sStatus = $latestStatus->name;
            if (in_array($sStatus, [Status::TEST_PASSED, Status::TEST_FAILED])) {
                $sStatus = 'Completed';
            }
            //  elseif (in_array($sStatus, [Status::ACCEPTED, Status::SUBMITTED, Status::UNDER_REVIEW])) {
            //     $sStatus = 'Accepted';
            // }
            $project = $projectTester->project ? $projectTester->project->toArray() : [];
            $project['status'] = $latestStatus->toArray();
            //  $project['rating'] = isset($projectRating[$project['id']]) ? $projectRating[$project['id']] : [];
            $project['rating'] = isset($project['id']) && isset($projectRating[$project['id']]) ? $projectRating[$project['id']] : [];
            if(isset($project['id'])){
                $aProjectIds[] =  $project['id'];
            }
            // $aProjectIds[] = isset($project['id']) ? $project['id'] : [];
            $sStatus = 'a' . $sStatus . 'Projects';
            $aData[$sStatus][] = $project;
        });

        if (empty($aData['aAcceptedProjects']) || $aData['isApprovedTester']) {
            $userDevices = Auth::user()->devices ? Auth::user()->devices->pluck('id')->toArray() : [];
            $aOpenProjects = Project::whereNotIn('id', $aProjectIds)->with(['projectType', 'devices']);
            $aOpenProjects->whereHas('devices', function ($query) use ($userDevices) {
                $query->whereIn('devices.id', $userDevices);
            });
            if ($isApprovedTester) {
                $aOpenProjects = $aOpenProjects->whereHas('status', function ($query) {
                    $query->where('name', Status::RUNNING);
                })
                    ->with('testers')
                    ->where('is_test_project', 0)->get();
                $aData['aOpenProjects'] = array_values($aOpenProjects->reject(function ($project) {
                    if (count($project->testers) < $project->allocated_tester) {
                        return false;
                    }
                    return true;
                })->toArray());
            } elseif (empty($aData['aSubmittedProjects'])) {
                $aData['aOpenProjects'] = $aOpenProjects->where(['is_test_project' => true])->get();
                $aData['aOpenProjects'] = $aData['aOpenProjects'] ? $aData['aOpenProjects']->toArray() : [];
            }
        } else {
            $aData['isApplicationSubmitted'] = in_array($aData['aAcceptedProjects'][0]['status']['name'], [Status::SUBMITTED, Status::UNDER_REVIEW]) ? true : false;
        }
        return $aData;
    }

    // Tester's specific project
    public function project($projectTesterId)
    {
        $projectTester = ProjectTester::where('id',$projectTesterId)->with([
            'issues' => function ($query) {
                $query->with(['issueType']);
            },'project' => function($query){
                $query->with(['projectType', 'publisher', 'questions', 'links', 'devices', 'media']);
                $query->withTrashed();
            },'tester' => function($query){
                $query->withTrashed();
            }])->first();
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
}
