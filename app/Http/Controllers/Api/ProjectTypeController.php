<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProjectType;
use App\Http\Resources\ProjectTypeResource;
use App\Http\Requests\ProjectTypeRequest;
use Illuminate\Support\Facades\DB;

class ProjectTypeController extends Controller
{
    public function index()
    {
        $filterableColumns = ['name', 'status', 'created_at'];
        $query = (new ProjectType())->newQuery();
        if (request('query')) {
            $query->where(function ($q) use ($filterableColumns) {
                foreach ($filterableColumns as $c) {
                    $q->orWhere($c, 'LIKE', '%' . request('query') . '%');
                }
            });
        }
        $data = $query->orderBy(request('column'), request('order'))
            ->paginate(request('limit'));
        return ProjectTypeResource::collection($data);
    }

    public function store(ProjectTypeRequest $request)
    {
        $type = new ProjectType([
            'name' => $request->get('name'),
            'status' => $request->get('status')
        ]);
        $type->save();
        return new ProjectTypeResource($type);
    }

    public function show($id)
    {
        $type = ProjectType::findOrFail($id);
        return new ProjectTypeResource($type);
    }

    public function update(Request $request, $id)
    {
        $type = ProjectType::findOrFail($id);
        $type->fill($request->all());
        $type->save();
        return new ProjectTypeResource($type);
    }

    public function destroy($id)
    {
        $type = ProjectType::findOrFail($id);
        $type->delete();
        return response()->json('', 204);
    }
}
