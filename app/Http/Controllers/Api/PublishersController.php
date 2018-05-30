<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;
use App\Models\Package;
use App\Http\Requests\PublisherRequest;
use App\Http\Resources\UserResource;
use App\Models\Status;
use App\Models\Project;
use Mail;
use App\Mail\InitePublisherMail;

class PublishersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $filterableColumns = ['first_name', 'last_name', 'middle_name', 'gender', 'created_at', 'email'];
        $query = (new User)->newQuery()->with('statuses', 'publisherProjects');
        if (request('query')) {
            $query->where(function ($q) use ($filterableColumns) {
                foreach ($filterableColumns as $c) {
                    $q->orWhere($c, 'LIKE', '%' . request('query') . '%');
                }
            });
        }
        $data = $query->whereHas('roles', function ($q) {
            $q->where('name', Role::PUBLISHER);
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
    public function store(PublisherRequest $request)
    {
        $aInput = $request->all();
        $aInput['password'] = bcrypt($aInput['password']);
        $aInput['token'] = str_random(40);
        $aInput['token_created_at'] = date('Y-m-d H:i:s');
        $oUser = User::create($aInput);
        // @TODO replace this with the id ofselected package
        /*$oUser->package()->associate(Package::defaultPackage());
        $oUser->save();*/
        $oUser->assignRole(Role::publisher()); //Assigning role to user
        $oUser->setStatus(Status::PENDING_ACTIVATION);
        //$email = 'chintan@techplusteam.com';
        $email = $oUser->email;
        Mail::to($email)->send(new InitePublisherMail($oUser));
        return new UserResource($oUser);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::with('status')->findOrFail($id);
        return new UserResource($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PublisherRequest $request, $id)
    {
        //
        $user = User::findOrFail($id);
        $user->fill($request->all());
        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }
        if ($request->has('status') && $request->status !== $user->status) {
            $user->setStatus($request->status);
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
        //
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json('', 204);
    }
}
