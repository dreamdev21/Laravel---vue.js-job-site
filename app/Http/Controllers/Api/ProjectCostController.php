<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectCostRequest;
use App\Models\Project;
use App\Models\Status;
use App\Models\User;

class ProjectCostController extends Controller
{
    public function calculate(ProjectCostRequest $request)
    {
        $perTester = 0;
        $user = auth()->user();
        if ($request->project_id) {
            $project = Project::findOrFail($request->project_id);
            $user = $project->publisher;
            return $this->calculateForProject($project, $user, $request->testers);
        }
        return $this->calculateForNewProject($user, $request->testers);
    }

    protected function calculateForProject(Project $project, User $user, $testers)
    {
        $totalProjects = $user->publisherProjects()->withTrashed()
            ->where('id', '!=', $project->id)
            ->currentStatusIn([Status::PENDING_PAYMENT, Status::RUNNING, Status::COMPLETED])
            ->count();
        return $this->countProcedure($testers, $user, $totalProjects);
    }

    protected function calculateForNewProject(User $user, $testersCount)
    {
        $totalProjects = $user->publisherProjects()->withTrashed()
            ->currentStatusIn([Status::PENDING_PAYMENT, Status::RUNNING, Status::COMPLETED])
            ->count();
        return $this->countProcedure($testersCount, $user, $totalProjects);
    }

    protected function countProcedure($testersCount, $user, $totalProjects)
    {
        $package = $user->package;
        if (!$package) {
            throw new \Exception('Payment Package is not selected');
        }
        $costPerTester = $package->calculateCostPerTester($testersCount, $totalProjects === 0);
        return $this->response($costPerTester, $testersCount * $costPerTester);
    }

    protected function response($costPerTester, $total)
    {
        return response()->json(['per_tester_cost' => $costPerTester, 'total' => $total]);
    }
}
