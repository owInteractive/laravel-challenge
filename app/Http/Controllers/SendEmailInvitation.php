<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Mail\EmailInvitation;

class SendEmailInvitation extends Controller
{
    public function  index (Request $request){
        
        $toEmail = new \stdClass; 
        

        $toEmail->name_friend = $request->name_friend;
        $toEmail->to_email    = $request->to_email;
        \Mail::to($toEmail->to_email)->send(new EmailInvitation($toEmail));
    }
}
