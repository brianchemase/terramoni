<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\VerificationCode;
use App\Models\User;
use App\Mail\DemoMail;
use Mail;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class AuthOtpController extends Controller
{
    //
    // Return View of OTP Login Page
    public function login()
    {
        return view('authe.otp-login');
    }


    public function generate(Request $request)
    {
        $request -> validate([
            'username'=>'required'
        ]);
        
        $username=$request->username;

        $clientdata= User::where('username','=', $request->username)->first();

        if($clientdata)
        {

        $client_phone= User::orderBy('id', 'desc')->where('username', $username)->first()->mobile_no;
        $user_id= User::orderBy('id', 'desc')->where('username', $username)->first()->id;
        $email= User::orderBy('id', 'desc')->where('username', $username)->first()->email;

       // return $client_phone;
        $phone="0725670606";
        $masked_phone = substr_replace($client_phone, 'XXXX', 4, 5);

        $otp = rand(1000, 9999);
        $request_time = now();

        $message="Your TerraMoni OTP is $otp";

        $mailData = [
            'title' => 'OTP Login',
            'body' => $message
        ];
         
        Mail::to($email)->send(new DemoMail($mailData));


       $saved= DB::table('verification_codes')->insert([
            'user_id' => $user_id,
            'otp' => $otp,
           // 'clientid' => $client_idno,
           'expire_at' => Carbon::now()->addMinutes(10)
        ]);

        if($saved)
                    {

                        //echo $message;
                        $apikey="6bffdc7405dd019325db9cfe3ec093e0";
                        $shortcode="TextSMS";
                        $partnerID="6712";
                        $serviceId=0;

			$smsdata=array(
				"apikey" => $apikey,
				"shortcode" => $shortcode,
				"partnerID"=> $partnerID,
				"mobile" => $client_phone,
				"message" => $message,
				//"serviceId" => $serviceId,
				//"response_type" => "json",
				);
				
			$smsdata_string=json_encode($smsdata);
			//echo $smsdata_string."\n";

			$smsURL="https://sms.textsms.co.ke/api/services/sendsms/";
           // $smsURL="";

			//POST
			$ch=curl_init($smsURL);
			curl_setopt($ch,CURLOPT_CUSTOMREQUEST,"POST");
			curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
			curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
			curl_setopt($ch,CURLOPT_POSTFIELDS,$smsdata_string);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
			curl_setopt($ch,CURLOPT_HTTPHEADER,array(
				'Content-Type: application/json',
				'Content-Length: '.strlen($smsdata_string)
				)	
			);
			$response=curl_exec($ch);
			$err = curl_error($ch);
			curl_close($ch);

       // send sms
        $request->session()->put('clientloggingid', $user_id);
        

                $data = [
                    'user_id' => $user_id,
                    'client_phone' => $masked_phone,
                    'otp' => $otp,

                ];
                $display_message="Kindly enter the OTP Sent to $masked_phone to login";
               // return redirect()->route('ClientverifyPage', $data)->with('success',  $message); 
                return redirect()->route('otp.verification', ['user_id' => $user_id])->with('success',  $display_message); 
                return redirect('/clients/verify')->with($data);
             }
             
             else{
                return back()->with('fail', 'Error, Contact system Admin for assistance.');
             }

            }
        else {
            return back()->with('fail', 'Error, No such user registered.');
        }


    }
    // Generate OTP
    public function generate1(Request $request)
    {

        $input = request()->all();
        //return $input;

        $username= $request->username;
       // return $username;
        # Validate Data
        // $request->validate([
        //     'username1' => 'required|exists:users,mobile_no'
        // ]);
        $user = DB::table('users')
            ->where('username', $username)
            ->first();

        $mobile_no = $user->mobile_no;

        //return $mobile_no;


       // $mobile_no="0725670606";

        

        # Generate An OTP
        $verificationCode = $this->generateOtp($request->mobile_no);

        $message = "Your OTP To Login is - ".$verificationCode->otp;
        # Return With OTP 

        return redirect()->route('otp.verification', ['user_id' => $verificationCode->user_id])->with('success',  $message); 
    }

    public function generateOtp($mobile_no)
    {
        //$user = User::where('mobile_no', $mobile_no)->first();

        $user = DB::table('users')
            ->where('mobile_no', $mobile_no)
            ->first();


        //return $user;

        # User Does not Have Any Existing OTP
        $verificationCode = VerificationCode::where('user_id', $user->id)->latest()->first();

        $now = Carbon::now();

        if($verificationCode && $now->isBefore($verificationCode->expire_at)){
            return $verificationCode;
        }

        // Create a New OTP
        return VerificationCode::create([
            'user_id' => $user->id,
            'otp' => rand(123456, 999999),
            'expire_at' => Carbon::now()->addMinutes(10)
        ]);
    }

    public function verification($user_id)
    {
        return view('authe.verify')->with([
            'user_id' => $user_id
        ]);
    }

    public function loginWithOtp(Request $request)
    {
        #Validation
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'otp' => 'required'
        ]);

        #Validation Logic
        $verificationCode   = VerificationCode::where('user_id', $request->user_id)->where('otp', $request->otp)->first();

        $now = Carbon::now();
        if (!$verificationCode) {
            return redirect()->back()->with('error', 'Your OTP is not correct');
        }elseif($verificationCode && $now->isAfter($verificationCode->expire_at)){
            return redirect()->route('otp.login')->with('error', 'Your OTP has been expired');
        }

        $user = User::whereId($request->user_id)->first();

        if($user){
            // Expire The OTP
            $verificationCode->update([
                'expire_at' => Carbon::now()
            ]);

            Auth::login($user);

            return redirect('/home');
        }

        return redirect()->route('otp.login')->with('error', 'Your Otp is not correct');
    }

    public function Appauthenticate(Request $request)
    {
        // Validate the request data
        $request->validate([
            'phone' => 'required',
            'pin' => 'required',
        ]);

        // Check if the phone and pin combination exist in the database
        $agent = DB::table('tbl_agents')
            ->where('phone', $request->input('phone'))
            ->where('access_pin', $request->input('pin'))
            ->first();

        // If no matching record found, return an error response
        if (!$agent) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }



         // If no matching record found, return an error response
        // If no matching record found or the account is not active, return an error response
        if (!$agent || $agent->status !== "approved") {
            return response()->json(['error' => 'Invalid credentials or account not activated'], 401);
        }

         // If authentication is successful, get the agent's terminals
         $terminals = DB::table('tbl_pos_terminals')
         ->where('agent_id', $agent->id)
         ->select('serial_no', 'status', 'assignment_date') // Specify the columns you want to fetch
         ->get();


        // If authentication is successful, return the selected fields as a response
        $responseFields = [
            'agent_id' => $agent->id,
            'fname' => $agent->first_name,
            'mname' => $agent->mid_name,
            'lname' => $agent->last_name,
            'email' => $agent->email,
            'gender' => $agent->gender,
            'location' => $agent->location,
            'bvn_no' => $agent->BVN,
            'doc_type' => $agent->doc_type,
            'doc_no' => $agent->doc_no,
            'terminals' => $terminals,
            // Add other fields you want to include in the response
        ];

        return response()->json($responseFields, 200);
    }
}
