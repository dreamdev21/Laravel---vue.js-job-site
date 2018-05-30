<?php

namespace App\Http\Controllers\Auth;

use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use App\Models\Status;
use App\Models\Package;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Mail\InvitationMail;
use App\Mail\InitePublisherMail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'last_name' => 'required|string|max:255',
            'country_id' => 'sometimes|exists:countries,id'
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = new User($request->all());
        $user->token = str_random(40);
        $user->password = bcrypt($request->password);
        if ($request->type === 'publisher') {
            $user->package()->associate(Package::defaultPackage());
        }
        $user->save();
        $user->setStatus(Status::PENDING_ACTIVATION);
        if ($request->type === 'publisher') {
            $user->assignRole(Role::publisher());
            \Mail::to($user)->send(new InitePublisherMail($user));
        }
        if ($request->type === 'tester') {
            $user->assignRole(Role::tester());
            \Mail::to($user)->send(new InvitationMail($user));
        }
        $user->load('roles');
        if ($request->wantsJson()) {
            return new UserResource($user);
        }
        return redirect($this->redirectPath());
    }

    public function resendActivation(Request $request)
    {
        Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id'
        ])->validate();
        $user = User::with('roles')->findOrFail($request->user_id);
        if ($user->hasRole(Role::publisher())) {
            \Mail::to($user)->send(new InitePublisherMail($user));
        }
        if ($user->hasRole(Role::tester())) {
            \Mail::to($user)->send(new InvitationMail($user));
        }
        return new UserResource($user);
    }
}
