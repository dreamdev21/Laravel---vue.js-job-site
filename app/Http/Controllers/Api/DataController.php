<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\ProjectTypeResource;
use App\Http\Resources\DeviceResource;
use App\Models\Country;
use App\Models\Device;
use App\Models\ProjectType;

class DataController extends Controller
{
    public function getCountries()
    {
        return Country::all()->toArray();
    }
    public function getDevices()
    {
        $deviceObject = new Device();
        $device = $deviceObject->where('status', '=', 'active')->get();
        return DeviceResource::collection($device);
    }
    public function getProjectTypes()
    {
        $projectObject = new ProjectType();
        $type = $projectObject->where('status', '=', 'active')->get();
        return ProjectTypeResource::collection($type);
    }
}
