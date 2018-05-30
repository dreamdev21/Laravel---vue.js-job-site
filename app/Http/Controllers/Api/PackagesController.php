<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\PackageRequest;
use App\Http\Resources\PackageResource;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filterableColumns = ['name', 'first_project_per_tester_charge', 'regular_per_tester_charge', 'created_at'];
        $query = (new Package)->newQuery();
        if (request('query')) {
            $query->where(function ($q) use ($filterableColumns) {
                foreach ($filterableColumns as $c) {
                    $q->orWhere($c, 'LIKE', '%' . request('query') . '%');
                }
            });
        }
        if (request('column') && request('order') && request('limit')) {
            $data = $query->orderBy(request('column'), request('order'))
                ->paginate(request('limit'));
        } else {
            $data = $query->get();
        }
        return PackageResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PackageRequest $request)
    {
        $package = new Package($request->validated());
        if ($request->is_default) {
            (new Package())->newQuery()->update(['is_default' => false ]);
        }
        $package->save();
        return new PackageResource($package);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $package = Package::findOrFail($id);
        return new PackageResource($package);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $package = Package::findOrFail($id);
        $package->fill($request->all());
        if ($request->is_default) {
            (new Package())->newQuery()->where('id', '!=', $id)->update(['is_default' => false ]);
        }
        $package->save();
        return new PackageResource($package);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        $package->delete();
        return response()->json('', 204);
    }
}
