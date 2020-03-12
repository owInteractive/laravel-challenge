<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use \App\User;

class EmailInvitation extends Mailable
{
    use Queueable, SerializesModels;


    public $user;

    public function __construct($toEmail)
    {
 
        $this->user = auth()->user();
        $this->user->dataEmail = $toEmail;

    }

     public function build()
    {
        $result =  $this->view('emails.user')
              ->with(['dataEmail' => $this->user]);

        return response()->json(
            [
                'status '=>$result,
                'Email foi enviado para '.$this->user->dataEmail->to_email
            ]
        );      

    }
}