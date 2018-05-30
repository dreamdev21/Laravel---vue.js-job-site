<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;
class ResetPasswordMail extends Mailable
{
  use Queueable, SerializesModels;
  
  protected $oUser;
  public function __construct(User $oUser)
  {
    $this->oUser = $oUser;
  }
  public function build()
  {
    return $this->view('emails.reset_password')
      ->subject('Your Beta Plan Reset Password')
      ->with(['token' => $this->oUser->token]);
  }
}