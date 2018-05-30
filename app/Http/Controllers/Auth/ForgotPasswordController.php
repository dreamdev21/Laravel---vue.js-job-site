<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Transformers\Json;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordMail;

class ForgotPasswordController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Password Reset Controller
  |--------------------------------------------------------------------------
  |
  | This controller is responsible for handling password reset emails and
  | includes a trait which assists in sending these notifications from
  | your application to your users. Feel free to explore this trait.
  |
   */
  
  use SendsPasswordResetEmails;
  
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest');
  }
  
  public function sendResetLinkEmail(Request $request)
  {
    $this->validate($request, ['email' => 'required|email']);
    if ($request->get('email')) {
      $user = User::where('email', $request->get('email'))->first();
      if (!$user) {
        return response()->json(Json::response(null, trans('passwords.user')), 400);
      }
      $token = $this->broker()->createToken($user);
      \Mail::to($user)->send(new ResetPasswordMail($user));
      return response()->json(Json::response(['token' => $token]));
    }
  }
}
