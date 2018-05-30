<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\DeviceRequest;
use App\Http\Resources\DeviceResource;
use App\Models\Device;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DevicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filterableColumns = ['name', 'status', 'created_at'];
        $query = (new Device)->newQuery()->with('media');
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
        return DeviceResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeviceRequest $request)
    {
        $device = new Device([
            'name' => $request->get('name'),
            'status' => $request->get('status')
        ]);
        $device->save();
        if ($request->hasFile('icon')) {
            $device->addMediaFromRequest('icon')->toMediaCollection('icon');
        }
        return new DeviceResource($device);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $device = Device::findOrFail($id);
        return new DeviceResource($device);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $device = Device::findOrFail($id);
        $device->fill($request->all());
        if ($request->hasFile('icon')) {
            if ($device->hasMedia('icon')) {
                $device->deleteMedia($device->getFirstMedia('icon'));
            }
            $device->addMediaFromRequest('icon')->toMediaCollection('icon');
        }
        $device->save();
        return new DeviceResource($device);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $device = Device::findOrFail($id);
        if ($device->hasMedia('icon')) {
            $device->deleteMedia($device->getFirstMedia('icon'));
        }
        $device->delete();
        return response()->json('', 204);
    }
}
