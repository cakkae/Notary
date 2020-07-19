<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Validator;
use Auth;
use Mail;
use App\Mail\SendMail;

class SendTestEmail extends Controller
{
    public function index(Request $request) {

    }

    public function send_email() {
        
        try {
            
            $user_id = request()->user_id;
            $email = request()->email;
            Mail::to($email)->send(new SendMail($email));

            return response()->json(['success' => 'Test email sent']);

       } catch (Throwable $e) {
            return response()->json(['error'=> $e]);
       }

    }
}
