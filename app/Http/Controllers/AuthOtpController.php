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
use Illuminate\Validation\Rule;


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

            $passport="https://portal.datacraftgarage.com/storage/ppts/$agent->passport";
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
            'passport' => $agent->passport,
            'passport_url' => $passport,
            'terminals' => $terminals,
            // Add other fields you want to include in the response
        ];

        return response()->json($responseFields, 200);
    }

    public function agentupdatePin(Request $request)
    {
        // Validate the request data
        $request->validate([
            'phone' => 'required',
            'pin1' => 'required',
            'pin2' => 'required|same:pin1',
        ]);

        $phone = $request->input('phone');
        $pin1 = $request->input('pin1');

        // Check if the agent with the given phone number exists in the database
        $existingAgent = DB::table('tbl_agents')->where('phone', $phone)->first();

        if (!$existingAgent) {
            return response()->json(['error' => 'Agent with the given phone number does not exist.'], 404);
        }

        // Update the pin in the database using DB facade
        DB::table('tbl_agents')->where('phone', $phone)->update(['access_pin' => $pin1]);

        return response()->json(['message' => 'Access PIN updated successfully.'], 200);
    }

    public function ValidateTransaction(Request $request)
    {
        // Validate the request data
        $request->validate([
            'agent_id' => 'required',
            'pin' => 'required',
        ]);

        // Check if the phone and pin combination exist in the database
        $agent = DB::table('tbl_agents')
            ->where('id', $request->input('agent_id'))
            ->where('access_pin', $request->input('pin'))
            ->first();

        // If no matching record found, return an error response
        if (!$agent) {
            return response()->json(['status_code' => '401','error' => 'Invalid credentials'], 401);
        }



         // If no matching record found, return an error response
        // If no matching record found or the account is not active, return an error response
        if (!$agent || $agent->status !== "approved") {
            return response()->json(['status_code' => '401','error' => 'Invalid credentials or account not activated'], 401);
        }

         // If authentication is successful, get the agent's terminals
         $terminals = DB::table('tbl_pos_terminals')
         ->where('agent_id', $agent->id)
         ->select('serial_no', 'status', 'assignment_date') // Specify the columns you want to fetch
         ->get();

        $passport="https://portal.datacraftgarage.com/storage/ppts/$agent->passport";
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
            'passport' => $agent->passport,
            'passport_url' => $passport,
            'terminals' => $terminals,
            // Add other fields you want to include in the response
        ];

        return response()->json(['status_code' => 200, 'Message' => 'Valid credentials', 'response' => $responseFields], 200);
    }


    public function agentsregister(Request $request)
    {
        // Validate the incoming registration data
        $validatedData = $request->validate([
            'first_name' => 'required',
            //'mid_name' => 'required',
            'last_name' => 'required',
            'dob' => 'required',
            'phone' => 'required|unique:tbl_agents|max:50',
            'email' => 'required|email|unique:tbl_agents|max:50',
            'gender' => 'required',
            'agent_type' => 'required',// agent type
            'agent_role' => 'required|in:agent,aggregators',
            'state' => 'required',
            'lga' => 'required',
            'location' => 'required',
            'country' => 'required',
            'BVN' => 'required',
            'tax_id' => 'required',
            'doc_type' => 'required',
            'doc_no' => 'required',
            'doc_issue_date' => 'required',
            'doc_exp_date' => 'required',
            'docimage' => 'required',
            'biz_address' => 'required',
            'passport' => 'required',
            'address_proff' => 'required',
            'bank_name' => 'required',
            'bank_acc_no' => 'required',
            //'agent_code' => 'required',
            //'access_pin' => 'required',
            'registration_date' => 'required',
            //'validation_date' => 'nullable|date',
        ]);


        $validatedData['status']="pending";
        $validatedData['access_pin']="0002";
        //optional values
        $validatedData['mid_name']= $request->input('mid_name', null);
        $validatedData['biz_name']= $request->input('biz_name', null);
        $validatedData['agent_code']= $request->input('agent_code', null);
        $validatedData['biz_cert']= $request->input('biz_cert', null);
        $validatedData['biz_reg_no']= $request->input('biz_reg_no', null);
        $validatedData['biz_state']= $request->input('biz_state', null);
        $validatedData['biz_lga']= $request->input('biz_lga', null);
   

        if ($request->hasFile('passport')) {
            $request->validate([
                'passport' => 'mimes:png,jpg,jpeg|max:20480',
            ]);
            $request->passport->store('ppts', 'public');

             // Add the passport path to the validated data
            $validatedData['passport'] = $request->passport->hashName();
        }

        if ($request->hasFile('address_proff')) {
            $request->validate([
                'address_proff' => 'mimes:png,jpg,jpeg|max:20480',
            ]);
            $request->address_proff->store('address', 'public');

             // Add the passport path to the validated data
            $validatedData['address_proff'] = $request->address_proff->hashName();
        }
         // Process the other_attachment
         if ($request->hasFile('docimage')) {
            $request->validate([
                'docimage' => 'mimes:png,jpg,jpeg|max:2048',
            ]);
            $request->docimage->store('address', 'public');
            $validatedData['docimage'] = $request->docimage->hashName();
        }

       

           // return $validatedData;
        //'address_proff' => $request->address_proof->hashName(),

        // Insert the agent's data into the database
        $agentId = DB::table('tbl_agents')->insertGetId($validatedData);

        // Return a response with the agent ID or any other relevant data
       // return response()->json(['agent_id' => $agentId], 201);

        return response()->json([
            'agent_id' => $agentId,
            'Data' => $validatedData,
            'message' => 'Agent registration successful.'
        ], 201);
    }


    public function storeCompanySelfReg_old(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'cname' => 'required',
            'business_registration_no' => 'required',
            'taxid' => 'required|string|max:255',
            'email' => 'required|email|unique:tbl_agents',
            'phone' => 'required',
            'business_address' => 'required',
            'business_location' => 'required',
            'business_street' => 'required',
            'business_lga' => 'required',
            'business_state' => 'required',
            'business_type' => 'required',
            //'lga' => 'required|string|max:255',
            //'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',


            //attachments
            'address_proof' => 'required',
            'business_cert_attachment' => 'required',
            'business_memorundum' => 'required',
            'business_statement_of_return' => 'required',
            'business_license_copy' => 'required',
            //'business_type' => 'required',
            //'business_type' => 'required',
        ]);

        // Process the 'address_proof' file upload
        if ($request->hasFile('address_proof')) {
            $request->validate([
                'address_proof' => 'mimes:png,jpg,jpeg|max:2048',
            ]);
            $request->address_proof->store('address', 'public');
        }


        if ($request->hasFile('business_cert_attachment')) {
            $request->validate([
                'business_cert_attachment' => 'mimes:png,jpg,jpeg|max:2048',
            ]);
            $request->business_cert_attachment->store('address', 'public');
        }


        if ($request->hasFile('business_memorundum')) {
            $request->validate([
                'business_memorundum' => 'mimes:png,jpg,jpeg|max:2048',
            ]);
            $request->business_memorundum->store('address', 'public');
        }


        if ($request->hasFile('business_statement_of_return')) {
            $request->validate([
                'business_statement_of_return' => 'mimes:png,jpg,jpeg|max:2048',
            ]);
            $request->business_statement_of_return->store('address', 'public');
        }

        if ($request->hasFile('business_license_copy')) {
            $request->validate([
                'business_license_copy' => 'mimes:png,jpg,jpeg|max:2048',
            ]);
            $request->business_license_copy->store('address', 'public');
        }

        // Extract data from the request
        $input = $request->all();
       // return $input;


        $docTypes = $request->input('doc_type');
        $docNumbers = $request->input('directordoc');
        $directorBVNs = $request->input('directorBVN');
        $tax_id = $request->input('taxid');
        $cname = $request->input('cname');
        //return $cname;
        $directorNames = $request->input('Dir_f_name');

         // Get the agent_id for reference when inserting directors
         $agentId = DB::getPdo()->lastInsertId();

          // Store director data
            $directorsData = $request->only([
                'Dir_f_name',
                'Dir_m_name',
                'Dir_l_name',
                'Dir_bvn_no',
                'Dir_tax_id',
                'Dir_doc_type',
                'Dir_doc_no',
                'Dir_phone',
                'Dir_email',
            ]);
     
             $directorsData = $request->input('directors');
             DB::beginTransaction();


        // Store data in the 'tbl_agents' table
        $inserted = DB::table('tbl_agents')->insertGetId([
            'first_name' => $input['cname'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'agent_type' => $input['business_type'],
            'agent_role' => 'aggregators',
            'tax_id' => $input['taxid'],
            'location' => $input['business_location'],
            'country' => $input['city'],
            'lga' => $input['business_lga'],
            'state' => $input['business_state'],
            'biz_name' => $input['cname'],
            'biz_address' => $input['business_address'],
            'biz_reg_no' => $input['business_registration_no'],
            'biz_state' => $input['business_state'],
            'biz_lga' => $input['business_lga'],
            'status' => 'pending',
            //'address_proff' => $request->address_proof->hashName(),
            'registration_date' => now()->toDateString(),
        ]);


         // Store director data
       //  $directorData = [];
         $agent=$inserted;
         return $inserted;

        //  foreach ($directorsData as $directorInfo) {
        //     $attachments = [];
        //     foreach ($directorInfo['Dir_doc_attachment'] as $attachment) {
        //         // Store or process each attachment as needed
        //         return $directorInfo;

        //         $path = $attachment->store('director_attachments');
        //         $request->Dir_doc_attachment->store('director_attachments', 'public');
        //         $attachments[] = $path;
                

        //      $directorData[] = [
        //          'agent_id' => $agent,
        //          'company_names' => $cname,
        //          'director_names' => $directorInfo['Dir_f_name']." ".$directorInfo['Dir_m_name']." ".$directorInfo['Dir_l_name'],
        //          'dir_bvn_no' => $directorInfo['Dir_bvn_no'],
        //          'tax_id' => $directorInfo['Dir_tax_id'],
        //          'doc_type' => $directorInfo['Dir_doc_type'],
        //          'doc_no' => $directorInfo['Dir_doc_no'],
        //          'doc_attachment' => $attachments[''],
        //          'director_phone' => $directorInfo['Dir_phone'],
        //          'email' => $directorInfo['Dir_email'],
        //      ];
        //     }
        //      //return $directorData;
        //  }

         //$directorData = [];
         $attachments = [];
       
         // Loop through each director
         foreach ($directorsData as $index => $directorInfo) {
            //return $index;
           // Loop through each attachment for this director
           foreach ($directorInfo['Dir_doc_attachment'] as $attachment) {
       
             // Store attachment
             $path = $attachment->store("director_{$index}_attachments");
       
             // Add to attachments array
             $attachments[] = $path;

       
           }
       
           // Add director data with attachments
           $directorData[] = [
             'agent_id' => $agentId,
             'company_names' => $cname,
            'director_names' => $directorInfo['Dir_f_name']." ".$directorInfo['Dir_m_name']." ".$directorInfo['Dir_l_name'],
            'dir_bvn_no' => $directorInfo['Dir_bvn_no'],
            'tax_id' => $directorInfo['Dir_tax_id'],
            'doc_type' => $directorInfo['Dir_doc_type'],
            'doc_no' => $directorInfo['Dir_doc_no'],
            'doc_attachment' => $attachments[''],
            'director_phone' => $directorInfo['Dir_phone'],
            'email' => $directorInfo['Dir_email'], 
             // other director fields
             'doc_attachment' => $attachments,
           ];
           
           // Reset attachments array
           $attachments = [];
       
         }

         DB::table('tbl_company_directors')->insert($directorData);

         DB::commit(); // Commit the transaction

        // Return a JSON response based on the result
        if ($inserted) {
            return response()->json(['message' => 'Your Agent data saved successfully'], 200);
        } else {
            return response()->json(['message' => 'Something went wrong, try again later or contact system admin'], 500);
        }
    }

    public function storeCompanySelfReg(Request $request)
        {
            // Validate the incoming request data
            $request->validate([
                'cname' => 'required',
                'business_registration_no' => 'required',
                'taxid' => 'required|string|max:255',
                'email' => 'required|email|unique:tbl_agents',
                'phone' => 'required',
                'business_address' => 'required',
                'business_location' => 'required',
                'business_street' => 'required',
                'business_lga' => 'required',
                'business_state' => 'required',
                'business_type' => 'required',
                'city' => 'required|string|max:255',

                // Attachments
                'address_proof' => 'required|file|mimes:png,jpg,jpeg|max:2048',
                'business_cert_attachment' => 'required|file|mimes:png,jpg,jpeg|max:2048',
                'business_memorundum' => 'required|file|mimes:png,jpg,jpeg|max:2048',
                'business_statement_of_return' => 'required|file|mimes:png,jpg,jpeg|max:2048',
                'business_license_copy' => 'required|file|mimes:png,jpg,jpeg|max:2048',
            ]);

            // Process and store attachments
            $attachments = [];

            foreach ([
                'address_proof',
                'business_cert_attachment',
                'business_memorundum',
                'business_statement_of_return',
                'business_license_copy'
            ] as $attachmentField) {
                if ($request->hasFile($attachmentField)) {
                    $file = $request->file($attachmentField);
                    $filename = uniqid() . '_' . $file->getClientOriginalName(); // Generate a unique filename
                    $path = $file->storeAs('address', $filename, 'public'); // Store the file with a unique name
                    $attachments[$attachmentField] = $filename; // Store the unique filename in the array
                }
            }

            // Extract data from the request
            $input = $request->all();

            DB::beginTransaction();

            // Store data in the 'tbl_agents' table
            $inserted = DB::table('tbl_agents')->insertGetId([
                'first_name' => $input['cname'],
                'phone' => $input['phone'],
                'email' => $input['email'],
                'agent_type' => $input['business_type'],
                'agent_role' => 'aggregators',
                'tax_id' => $input['taxid'],
                'location' => $input['business_location'],
                'country' => $input['city'],
                'lga' => $input['business_lga'],
                'state' => $input['business_state'],
                'biz_name' => $input['cname'],
                'biz_address' => $input['business_address'],
                'biz_reg_no' => $input['business_registration_no'],
                'biz_state' => $input['business_state'],
                'biz_lga' => $input['business_lga'],
                'status' => 'pending',
                'biz_cert' => $attachments['business_cert_attachment'],
                'biz_memo' => $attachments['business_memorundum'],
                'biz_statement' => $attachments['business_statement_of_return'],
                'biz_license' => $attachments['business_license_copy'],
                'address_proff' => $attachments['address_proof'],
                'registration_date' => now()->toDateString(),
            ]);

            if ($inserted) {
                DB::commit();
                return response()->json([
                    'status_code' => 200,
                    'message' => 'Your Agent data saved successfully',
                    'CompanyName' => $input['cname'],
                    'agentID' => $inserted
                ], 200);
            } else {
                DB::rollBack();
                return response()->json(['message' => 'Something went wrong, try again later or contact the system admin'], 500);
            }
        }

        public function registerDirector(Request $request)
        {
            // Validate the incoming request data
            $request->validate([
                'company_name' => 'required|string',
                'company_id' => 'required|string',
                'Dir_f_name' => 'required|string',//first name
                'Dir_m_name' => 'string|nullable',
                'Dir_l_name' => 'required|string',
                'Dir_bvn_no' => 'required|string|max:255',
                'Dir_tax_id' => 'required|string|max:255',
                'Dir_doc_type' => 'required|string',
                'Dir_doc_no' => 'required|string|max:255',
                'Dir_phone' => 'required|string',
                'Dir_email' => 'required|email',
                'Dir_doc_attachment' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);

            // Process and store the director's attachment
            if ($request->hasFile('Dir_doc_attachment')) {
                $attachment = $request->file('Dir_doc_attachment');
                $attachmentPath = $attachment->store('address', 'public');
                $attachmentStoredName = $attachment->hashName(); // Get the name of the file as it's stored
            }

            // Use the DB facade to insert data into the database
            $directorId = DB::table('tbl_company_directors')->insertGetId([
                'company_names' => $request->company_name,
                'agent_id' => $request->company_id,
                'director_names' => $request->Dir_f_name." ".$request->Dir_m_name." ".$request->Dir_l_name,
                // 'first_name' => $request->Dir_f_name,
                // 'middle_name' => $request->Dir_m_name,
                // 'last_name' => $request->Dir_l_name,
                'dir_bvn_no' => $request->Dir_bvn_no,
                'tax_id' => $request->Dir_tax_id,
                'doc_type' => $request->Dir_doc_type,
                'doc_no' => $request->Dir_doc_no,
                'director_phone' => $request->Dir_phone,
                'email' => $request->Dir_email,
                'doc_attachment' => $attachmentStoredName, // Store the file path
            ]);

            if ($directorId) {
                return response()->json(['status_code'=>200,'message' => 'Director registered successfully'], 201);
            } else {
                return response()->json(['message' => 'Failed to register director'], 500);
            }
        }

        public function getDirectorsList($agentId)
        {
            $directors = DB::table('tbl_company_directors')
                ->where('agent_id', $agentId)
                ->select( 'director_names','doc_no', 'director_phone','email') // Add the fields you want to include
                ->get();

            return response()->json($directors);


        }





    
    
}
