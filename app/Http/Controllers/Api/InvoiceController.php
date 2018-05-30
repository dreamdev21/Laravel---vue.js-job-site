<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Resources\InvoiceResource;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($projectId)
    {
        $project = Project::findOrFail($projectId);
        if (!(auth()->user()->isAdmin() || $project->publisher->id === auth()->user()->id)) {
            abort(403);
        }
        if (!$project->invoice) {
            abort(404);
        }
        return new InvoiceResource($project->invoice);
    }
}
