<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\SystemRequest;
use App\Models\System;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\SystemResource;
use Auth;
class SystemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aSystems = User::with('systems')->where('users.id',Auth::user()->id)->get();
        return SystemResource::collection($aSystems[0]->systems);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Insertion : Table - systems
        $aInput = $request->all();
        $oSystemInfo = System::create($aInput);
        // Insertion : Table - user_systems
        $oUser = User::find(Auth::user()->id);
        $oUser->systems()->attach($oSystemInfo);
        return new SystemResource($oSystemInfo);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $oSystem = System::findOrFail($id);
        return new SystemResource($oSystem);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $oSystem = System::findOrFail($id);
        $oSystem->fill($request->all());
        $oSystem->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $oSystem = System::findOrFail($id);
        $oSystem->delete();
        return response()->json('', 204);
    }
}
