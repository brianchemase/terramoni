<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Mail;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use App\Mail\DemoMail;


class AgentsController extends Controller
{
    //
    public function dashboard()
    {
        $currentHour = Carbon::now()->hour;
        $salutation = '';

        if ($currentHour >= 0 && $currentHour < 12) {
            $salutation = 'Good Morning';
        } elseif ($currentHour >= 12 && $currentHour < 18) {
            $salutation = 'Good Afternoon';
        } else {
            $salutation = 'Good Evening';
        }

        $transactions = DB::table('tbl_transactions')->get();

        //count all the agents
        $agentCount = DB::table('tbl_agents')->count();
        //count all the POS
        $POSCount = DB::table('tbl_pos_terminals')->count();

        $data = [
            'salutation' => $salutation,// salutations
            'agentCount' => $agentCount,// counts number of agents
            'POSCount' => $POSCount,// counts number of POS
            'transactions' => $transactions,// Transactions lists
            // Add more data to the array as needed
        ];

        return view ('agents.home')->with($data);;
    }

    public function form()
    {
        return view ('agents.form');
    }
    public function blank()
    {
        return view ('agents.underconstraction');
    }


    public function tables()
    {
        return view ('agents.table');
    }
    
    
    public function available_music()
    {
        $data = DB::table('tbl_uploaded_music_submission')->where('status', 'approved')->get();
        $data = DB::table('tbl_uploaded_music_submission')->get();

        //$data = DB::table('tbl_uploaded_music_submission')->select('id', 'title')->get();
       // return $data;


        return view ('agents.availablemusictable',compact('data'));
    }

    public function agentstab()
    {
        $agents = DB::table('tbl_agents')->get();

       // return $agents;
        return view ('agents.agentstable', compact('agents'));
    }

    public function compliance_agentstab()
    {
        $agents = DB::table('tbl_agents')
            ->where('status', '!=', 'approved')
            ->get();


       // return $agents;
        return view ('agents.pendingagentstable', compact('agents'));
    }

    public function agentsposallocation()
    {
        $agents = DB::table('tbl_agents')
            ->where('status', 'approved')
            ->get();


        $pos_terminals = DB::table('tbl_pos_terminals')
            ->where('status', 'available')
            ->get();


       //return $pos_terminals;
        return view ('agents.posallocation', compact('agents','pos_terminals'));
    }

    public function savenewagent(Request $request)
	{
        $input = request()->all();
       // return $input;


		$request->validate([
			'fname'=>'required',
			//'mname'=>'required',
			'lname'=>'required',
			//'email'=>'required|email|unique:clients_data',
			'gender'=>'required',
			'phone'=>'required',
			'location'=>'required',
			//'station'=>'required',
			//'id_number'=>'required|unique:clients_data|min:5|max:12'
	   ]);

	   if ($request->hasFile('ppt')) {

		$request->validate([
			'ppt' => 'mimes:png,jpg,jpeg|max:2048' // Only allow .jpg, .bmp and .png file types.
		]);

        $finfo = new \finfo(FILEINFO_MIME_TYPE);
		 // Save the file locally in the storage/public/ folder under a new folder named /ppts
		 $request->ppt->store('ppts', 'public');

         if ($request->file('ppt')->isValid()) {
            $path = $request->file('ppt')->store('ppts', 'public');
        
            //return $path;
        }


      $save= DB::table('tbl_agents')->insert([
            'first_name' => $input['fname'],
            'last_name' => $input['lname'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'gender' => $input['gender'],
            'location' => $input['location'],
            'country' => $input['country'],
            'status' => 'active', // Assuming you want to set the default status
            'BVN' => $input['bvn'],
            'national_id_no' => $input['id_no'],
            'passport' => $request->ppt->hashName(),
            'registration_date' => date('Y-m-d'), // Assuming you want to set the current date
            'validation_date' => null, // Assuming the validation date is initially null
        ]);
        


		 if($save){
		   //Mail::to($email)->send(new AccountRegistration($fname,$username));
		   return back()->with('success','New Agent data has been successfuly added');
		 }else{
			 return back()->with('fail','Something went wrong, try again later or contact system admin');
		 }
	   //return $request;
		}
	}

    public function storeselfregagent(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'first_name' => 'required|max:50',
            //'mid_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'phone' => 'required|max:50',
            'email' => 'required|max:50',
            'gender' => 'required|max:50',
            'location' => 'required|max:225',
            'country' => 'required|max:225',
            'BVN' => 'required|max:50',
            'national_id_no' => 'required|max:50',
            //'passport' => 'required|max:225',
           // 'birth_date' => 'required|date',
            // Add additional validation rules for other fields
        ]);

        // Store the agent record in the database using DB facade
        $agentData = [
            'first_name' => $validatedData['first_name'],
            //'mid_name' => $validatedData['mid_name'],
            'last_name' => $validatedData['last_name'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'gender' => $validatedData['gender'],
            'location' => $validatedData['location'],
            'country' => $validatedData['country'],
            'status' => 'pending',
            'BVN' => $validatedData['BVN'],
            'national_id_no' => $validatedData['national_id_no'],
            //'passport' => $validatedData['passport'],
            'registration_date' => date('Y-m-d'),
            'validation_date' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $inserted = DB::table('tbl_agents')->insert($agentData);

        if ($inserted) {
            return Redirect::back()->with('success', 'Agent data saved successfully!');
        } else {
            return Redirect::back()->with('error', 'Error occurred while saving agent data. Please try again.');
        }
    }

    public function aggregatorstab()
    {
        return view ('agents.aggregatorstable');
    }

    public function postterminalstab()
    {
        $pos_terminals = DB::table('tbl_pos_terminals')->get();

        //return $pos_terminals;
        return view ('agents.posstable', compact('pos_terminals'));
    }
    public function savePosData(Request $request)
    {
        $deviceName = $request->input('device_name');
        $serialNo = $request->input('serialno');
        $deviceOS = $request->input('device_os');
        $status="available";
        $owner_type="Store";
        $registration_date= Carbon::now();

        // Insert data into the tbl_pos_terminals table
        DB::table('tbl_pos_terminals')->insert([
            'device_name' => $deviceName,
            'serial_no' => $serialNo,
            'device_os' => $deviceOS,
            'status' => $status,
            'owner_type' => $owner_type,
            'registration_date' => $registration_date,
        ]);

        // Redirect back or to a success page
        return redirect()->back()->with('success', 'POS data saved successfully.');
    }

   

    public function agentselfregistration()
    {
        return view ('selfregportal.register');
    }

    public function storeTransaction(Request $request)
    {

        $input = request()->all();
    // return $input;
        // Validate the request data if needed
         // Validate the request data
         $validatedData = $request->validate([
            'Id' => 'required|string|max:10',
            'Name' => 'required|string|max:255',
            'BillerName' => 'required|string|max:255',
            'ConsumerIdField' => 'required|string|max:255',
            'Code' => 'required|string|max:10',
            'BillerType' => 'required|string|max:10',
            'ItemFee' => 'required|string|max:10',
            'Amount' => 'required|string|max:10',
            'BillerId' => 'required|string|max:10',
            'BillerCategoryId' => 'required|string|max:10',
            'CurrencyCode' => 'required|string|max:10',
            'CurrencySymbol' => 'required|string|max:10',
            'ItemCurrencySymbol' => 'nullable|string|max:10',
            'IsAmountFixed' => 'required|boolean',
            'SortOrder' => 'required|integer',
            'PictureId' => 'required|integer',
            'PaymentCode' => 'required|string|max:10',
            'UssdShortCode' => 'required|string|max:255',
            'AmountType' => 'required|integer',
            'PaydirectItemCode' => 'required|string|max:10',
        ]);

        // Insert the data into the tbl_transactions table
        $result = DB::table('tbl_transactions')->insert($validatedData);

        if ($result) {
            // Return a success response
            return response()->json(["status_code" => 201,"success" => true, 'message' => 'Transaction stored successfully'], Response::HTTP_CREATED);
        } else {
            // Return an error response
            return response()->json(["success" => false, 'message' => 'Failed to store transaction'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function storeSms(Request $request)
    {
        $json = $request->getContent();

        $data = json_decode($json, true);

        $messageData = $data['SMSMessageData'];
        $recipient = $messageData['Recipients'][0];

        $agent_id = rand(1, 899);
        $agent = DB::table('tbl_agents')
            ->select('first_name', 'last_name')
            ->where('id', $agent_id)
            ->first();

        $agent_names = null;
        if ($agent) {
            $agent_names = $agent->first_name . ' ' . $agent->last_name;
        }


        $insertData = [
            'Name' => $messageData['Message'],
            //'recipient_status' => $recipient['status'],
            'BillerName' => $recipient['number'],
           // 'recipient_message_id' => $recipient['messageId'],
            'ConsumerIdField' => $agent_names,
            'BillerType' => 'SMS Purchase',
            'ItemFee' => $recipient['cost'],
        ];

        DB::table('tbl_transactions')->insert($insertData);

        return response()->json(['success' => true]);
    }

    public function user_profile()
    {
        return view ('agents.userprofile');
    }

    public function musicpage()
    {
        return view ('agents.viewmusicpage');
    }

    public function mailtest()
    {
        $mailData = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp.'
        ];
         
        Mail::to('brianchemo@gmail.com')->send(new DemoMail($mailData));
           
        dd("Email is sent successfully.");
    }
}
