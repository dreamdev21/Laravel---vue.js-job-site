<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TesterEarningRequest;
use App\Http\Resources\TesterEarningResource;
use App\Models\Project;
use App\Models\User;
use App\Models\TesterEarning;
use DB;
use Exception;

class TesterEarningsController extends Controller
{
    public function forProjects($projectId)
    {
        $earnings = TesterEarning::with('tester')->whereHas('project', function ($builder) use ($projectId) {
            $builder->where('project_id', $projectId);
        })->get();
        return response()->json($earnings->map->tester->map->id);
    }

    public function store(TesterEarningRequest $request)
    {
        $project = Project::findOrFail($request->project_id);
        $tester = User::findOrFail($request->tester_id);
        if (!$project->testers->contains($tester)) {
            return abort(422, 'tester does not belongs to that project');
        }
        $projectPayment = $tester->earnings->first(function ($earning) use ($project) {
            return $earning->project_id === $project->id && (!$earning->is_bonus);
        });
        $bonusPayment = $tester->earnings->first(function ($earning) use ($project) {
            return $earning->project_id === $project->id && $earning->is_bonus;
        });
        if ($request->is_bonus && $bonusPayment) {
            return abort(422, 'bonus has already been paid');
        }
        if (!$request->is_bonus && $projectPayment) {
            return abort(422, 'project payment has already been paid');
        }
        DB::beginTransaction();
        try {
            $earning = new TesterEarning();
            $earning->is_bonus = $request->is_bonus;
            $earning->amount = $request->amount;
            $earning->note = $request->note;
            $earning->tester()->associate($tester);
            $earning->project()->associate($project);
            if (!$tester->wallet) {
                $tester->refresh();
                $tester->createWallet();
            }
            $tester->wallet->add($request->amount);
            $earning->balance_after = $tester->wallet->getBalance();
            $earning->save();
            DB::commit();
            return new TesterEarningResource($earning);
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
