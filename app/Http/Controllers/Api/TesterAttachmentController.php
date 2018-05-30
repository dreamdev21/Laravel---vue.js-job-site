<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Resources\MediaResource;
use App\Http\Requests\TesterAttachmentRequest;
use App\Models\User;

class TesterAttachmentController extends Controller
{
    protected function canChange($project, $tester)
    {
        return auth()->user()->isAdmin() ||
            auth()->user()->id == $project->publisher->id ||
            $project->testers->contains($tester);
    }

    public function index($projectId, $testerId)
    {
        $tester = User::findOrFail($testerId);
        $project = Project::findOrFail($projectId);
        if (!$this->canChange($project, $tester)) {
            return abort(403, 'unauthorized');
        }
        $projectTester = $project->testers->first(function ($tester) use ($testerId) {
            return $testerId == $tester->id;
        });
        return MediaResource::collection($projectTester->pivot->getMedia());
    }

    public function store(TesterAttachmentRequest $request, $projectId, $testerId)
    {
        $tester = User::findOrFail($testerId);
        $project = Project::findOrFail($projectId);
        if (!$this->canChange($project, $tester)) {
            return abort(403, 'unauthorized');
        }
        $projectTester = $project->testers->first(function ($tester) use ($testerId) {
            return $testerId == $tester->id;
        });
        $mediaCollection = $projectTester->pivot->addAllMediaFromRequest('file')
            ->map(function ($fileAdder) {
                return $fileAdder->toMediaCollection();
            });
        return MediaResource::collection($mediaCollection);
    }

    public function destroy($projectId, $testerId, $mediaId)
    {
        $tester = User::findOrFail($testerId);
        $project = Project::findOrFail($projectId);
        if ($testerId != auth()->user()->id) {
            return abort(403, 'unauthorized');
        }
        $projectTester = $project->testers->first(function ($tester) use ($testerId) {
            return $testerId == $tester->id;
        });
        $media = $projectTester->pivot->media()->findOrFail($mediaId);
        $media->delete();
        return response()->json('', 204);
    }
}
