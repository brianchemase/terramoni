<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MyDemoMail;
use Mail;

class NotificationController extends Controller
{
    //
    public function myDemoMail()
    {
        $myEmail = 'aatmaninfotech@gmail.com';

        $access_code="1235";
        $access_code = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
        $phone="0725670606";

        $message="Your account has beed registered successfully. Use the access code: $access_code. ";
   
        $details = [
            'title' => 'Account Successfully Approved',
            'url' => 'https://www.itsolutionstuff.com',
            'access'=> $access_code,
            'phone'=> $phone,
            'message'=> $message,
        ];
  
        Mail::to($myEmail)->send(new MyDemoMail($details));
   
        dd("Mail Send Successfully");
    }

}
