<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Http\Resources\UserResource;
use App\Models\Status;
use Spatie\Activitylog\Models\Activity;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/portal';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public function attemptLogin(Request $request)
    {
        $user = User::where('email', $request->email)
            ->role($request->type === 'tester' ? Role::TESTER : Role::PUBLISHER)
            ->first();
        if ($user && \Hash::check($request->password, $user->password)) {
            \Auth::login($user);
            $user->save();
            if($request->type === 'publisher') {
                $user->setStatus(Status::ACTIVE);
                activity()
                  ->inLog('publisher-project')
                  ->causedBy(auth()->user())
                  ->log('Sign in');
            }
            $this->redirectTo = '/portal/' . $request->type === 'tester' ? 'tester' : 'publisher';
            if ($request->wantsJson()) {
                $user->load('roles');
                return new UserResource($user);
            }
            return redirect()->to($this->redirectTo);
        }
        return $this->sendFailedLoginResponse($request);
    }

    public function logout()
    {
        \Auth::logout();
        if (request('next')) {
            return redirect()->to(request('next'));
        }
        return redirect()->to('/site');
    }
}
