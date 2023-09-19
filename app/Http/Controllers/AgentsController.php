<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Mail;

use App\Imports\PosTerminalsImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Response;
use App\Mail\DemoMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class AgentsController extends Controller
{
    public function dashboard()
    { 

        // Permission::create(['name' => 'view-admin-dashboard','guard_name'=>'web']);
        // $adminRole = Role::findByName('Admin01');

        // $adminRole->givePermissionTo([
        //     'view-admin-dashboard',
        // ]);

        

    

        $currentHour = Carbon::now()->hour;
        $salutation = '';

        if ($currentHour >= 0 && $currentHour < 12) {
            $salutation = 'Good Morning';
        } elseif ($currentHour >= 12 && $currentHour < 18) {
            $salutation = 'Good Afternoon';
        } else {
            $salutation = 'Good Evening';
        }

        //$transactions = DB::table('tbl_transactions')->get();
        $transactions = DB::table('tbl_transactions')
                ->orderBy('Id', 'desc')
                ->get();

        //count all the agents
        $agentCount = DB::table('tbl_agents')->where('agent_role', 'agent')->count();
        //active agents
        $activeAgentsCount = DB::table('tbl_agents')->where('agent_role', 'agent')->where('status', 'approved')->count();
        // inactive agents
        $inactiveAgentsCount = DB::table('tbl_agents')->where('agent_role', 'agent')->where('status', '<>', 'approved')->count();





        //count all the POS
        $POSCount = DB::table('tbl_pos_terminals')->count();

        //assisgned pos
         $assignedPOSCount = DB::table('tbl_pos_terminals')->where('status', 'Assigned')->count();

          //assisgned pos
        $notassignedPOSCount = DB::table('tbl_pos_terminals')->where('status','<>', 'Assigned')->count();

       //$totalTransactioncount= rand(10000, 50000);
       $totalTransactioncount = DB::table('tbl_transactions')->count();
       //$totalTransactionValue= rand(10000, 50000);
       $totalTransactionValue = DB::table('tbl_transactions')->sum('ItemFee');

       // wallet earning
       $walletBalance = rand(10000, 50000);
       $walletearningBalance = rand(10000, 50000);

       $totalaggregators= rand(0, 910);
      
       $activeaggregators = rand(0, $totalaggregators);
       $inactiveaggregators=$totalaggregators-$activeaggregators; 

        //count all the aggregators
        $totalaggregators = DB::table('tbl_agents')->where('agent_role', 'aggregators')->count();
        //active aggregators
        $activeaggregators = DB::table('tbl_agents')->where('agent_role', 'aggregators')->where('status', 'approved')->count();
        // inactive aggregators
        $inactiveaggregators = DB::table('tbl_agents')->where('agent_role', 'aggregators')->where('status', '<>', 'approved')->count();


        $topEarningAgents = DB::table('tbl_agents AS a')
        ->select('a.first_name', 'a.last_name', 'a.email', 'a.location','a.passport','a.status', DB::raw('SUM(c.commission) AS earnings'))
        ->join('tbl_commissions AS c', 'a.id', '=', 'c.agent_id')

        ->groupBy('a.id', 'a.first_name', 'a.last_name', 'a.email', 'a.location', 'a.passport', 'a.status')

        ->where('a.agent_role', '=', 'agent') // Adding the condition

        ->orderByDesc('earnings')
        ->limit(5)
        ->get();


        // Retrieve data and sum up ItemFee
            $monthlySum = DB::table('tbl_transactions')
            ->selectRaw('MONTH(transaction_date) AS month, SUM(ItemFee) AS total_fee')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Format data for the chart
        $Monthlabels = [];
        $Monthlydata = [];

        foreach ($monthlySum as $entry) {
            $Monthlabels[] = date("M", mktime(0, 0, 0, $entry->month, 1));
            $Monthlydata[] = $entry->total_fee;
        }




        $data = [
            'salutation' => $salutation,// salutations
            'agentCount' => $agentCount,// counts number of agents
            'activeAgentsCount' => $activeAgentsCount,// counts number of active agents
            'inactiveAgentsCount' => $inactiveAgentsCount,// counts number of inactive agents
            'assignedPOSCount' => $assignedPOSCount,// counts number of POS
            'notassignedPOSCount' => $notassignedPOSCount,// counts number of POS
            'POSCount' => $POSCount,// counts number of POS
            'transactions' => $transactions,// Transactions lists
            'totalTransactioncount' => $totalTransactioncount,// Transactions lists
            'totalTransactionValue' => $totalTransactionValue,// Transactions lists
            'walletBalance' => $walletBalance,// wallet balance
            'walletearningBalance' => $walletearningBalance,// WAllet balance
            'totalaggregators' => $totalaggregators,// total aggregators
            'activeaggregators' => $activeaggregators,//active aggregators
            'inactiveaggregators' => $inactiveaggregators,//inactive aggregators

            'topEarningAgents' => $topEarningAgents,//top 5 earning agents
            'Monthlabels' => $Monthlabels,//monthly data
            'Monthlydata' => $Monthlydata,//top 5 earning agents
            // Add more data to the array as needed
        ];

        return view ('agents.home')->with($data);
    }

    public function form()
    {
        return view ('agents.form');
    }
    public function blank()
    {
        return view ('agents.underconstraction');
    }

    public function permissions()
    {
        $permissions = DB::table('tbl_permissions')
                ->orderBy('id', 'desc')
                ->get();

               // return $permissions;

                $data = [
                    'permissions' => $permissions,// salutations
                   
                    // Add more data to the array as needed
                ];

        return view ('agents.permissionsmatrix')->with($data);
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
        $agents = DB::table('tbl_agents')->where('agent_role','agent')->get();

       // return $agents;
        return view ('agents.agentstable', compact('agents'));
    }

    public function edit_agent($agent_id)
    {
        $agent = DB::table('tbl_agents')->where('id', $agent_id)->first();
        //return $agent;

        return view('agents.agentDetailsUpdate', compact('agent'));
    }

    public function update_agent(Request $request, $agent_id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'bvn' => 'required',
            'tax_id' => 'nullable',
            'doc_type' => 'nullable',
            'doc_no' => 'nullable',
            'bank_name' => 'nullable',
            'bank_acc_no' => 'nullable',
            // Add validation rules for other fields
        ]);

        // Update agent's data
        DB::table('tbl_agents')->where('id', $agent_id)->update([
            'first_name' => $request->input('first_name'),
            'mid_name' => $request->input('mid_name'),
            'last_name' => $request->input('last_name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'bvn' => $request->input('bvn'),
            'tax_id' => $request->input('tax_id'),
            'doc_type' => $request->input('doc_type'),
            'doc_no' => $request->input('doc_no'),
            'bank_name' => $request->input('bank_name'),
            'bank_acc_no' => $request->input('bank_acc_no'),
            // Update other fields
        ]);

        return redirect()->route('agentstab', ['agent_id' => $agent_id])
            ->with('success', 'Agent details updated successfully!');
    }

    public function suspend_agent($agent_id)
    {

       // Get agent's information
       $agent = DB::table('tbl_agents')->where('id', $agent_id)->first();

       if (!$agent) {
           return back()->with('error', 'Agent not found!');
       }

       $agentRole = $agent->agent_role;

       // Update agent's status to "suspended"
       DB::table('tbl_agents')->where('id', $agent_id)->update(['status' => 'suspended']);

       $message = ($agentRole === 'agent') ? 'Agent suspended' : 'Aggregator suspended';

       return back()->with('success', $message . ' successfully!');


    }

    public function reject_agent($agent_id)
    {

       // Get agent's information
       $agent = DB::table('tbl_agents')->where('id', $agent_id)->first();

       if (!$agent) {
           return back()->with('error', 'Agent not found!');
       }

       $agentRole = $agent->agent_role;

       // Update agent's status to "suspended"
       DB::table('tbl_agents')->where('id', $agent_id)->update(['status' => 'rejected']);

       $message = ($agentRole === 'agent') ? 'Agent Application Rejected' : 'Aggregator Application Rejected';

       if ($agentRole=="agent"){

         // return back()->with('success', $message . ' successfully!');
       return Redirect::route('complianceagentstab')->with('error', $message . ' successfully!');
       }
       else{
        return Redirect::route('complianceaggregatorsstab')->with('error', $message . ' successfully!');
       }

    }

    public function escalate_agent($agent_id)
    {

       // Get agent's information
       $agent = DB::table('tbl_agents')->where('id', $agent_id)->first();

       if (!$agent) {
           return back()->with('error', 'Agent not found!');
       }

       $agentRole = $agent->agent_role;

       // Update agent's status to "suspended"
       DB::table('tbl_agents')->where('id', $agent_id)->update(['status' => 'escalated']);

       $message = ($agentRole === 'agent') ? 'Agent Application Escalated' : 'Aggregator Application Escalated';

       if ($agentRole=="agent"){

         // return back()->with('success', $message . ' successfully!');
       return Redirect::route('complianceagentstab')->with('error', $message . ' successfully!');
       }
       else{
        return Redirect::route('complianceaggregatorsstab')->with('error', $message . ' successfully!');
       }

    }

    public function allocatedPOS($agent_id)
    {

        $pos_terminals = DB::table('tbl_pos_terminals')->where('agent_id', $agent_id)->get();
        //return $pos_terminals;

        $first_name = DB::table('tbl_agents')->where('id', $agent_id)->value('first_name');
        $mid_name = DB::table('tbl_agents')->where('id', $agent_id)->value('mid_name');
        $last_name = DB::table('tbl_agents')->where('id', $agent_id)->value('last_name');

        $agentnames=$first_name." ".$last_name;

        return view ('agents.allocatedposstable', compact('pos_terminals','agentnames'));


    }




    public function compliance_agentstab()
    {
        $agents = DB::table('tbl_agents')
            ->where('status', '!=', 'approved')
            ->get();


       // return $agents;
        return view ('agents.pendingagentstable', compact('agents'));
    }

    public function compliance_aggregatorstab()
    {
        $aggregators = DB::table('tbl_agents')
            ->where('status', '!=', 'approved')
            ->where('agent_role', 'aggregators')
            ->get();


       // return $aggregators;
        return view ('agents.pendingaggregatorstable', compact('aggregators'));
    }

    public function agentsposallocation()
    {
        $agents = DB::table('tbl_agents')
            ->where('status', 'approved')
            ->get();


        $pos_terminals = DB::table('tbl_pos_terminals')
            ->where('status', 'available')
            ->get();


       //return $agents;
        return view ('agents.posallocation', compact('agents','pos_terminals'));
    }

    public function updateagentposallocation(Request $request)
    {

        $input = $request->all();
      

         // Retrieve the selected agent ID from the form
        $agentId = $request->input('agentid');

        // Retrieve the selected POS IDs from the form
        $posIds = $request->input('posid');
        $posCount = count($posIds);

        $agentNames = DB::table('tbl_agents')
            ->whereIn('id', [$agentId])
            ->pluck(DB::raw("CONCAT(first_name, ' ', last_name) as full_name"))
            ->first();

       // return $agentNames;

        // Perform any necessary validation or processing here

        $allocate= DB::table('tbl_pos_terminals')
            ->whereIn('id', $posIds)
            ->update([
                'agent_id' => $agentId,
                'owner_name' => $agentNames,
                'owner_type' => 'Agent',
                'assignment_date' => now(),
                'status' => 'Assigned'
            ]);


        // return $input;

        if($allocate){
            //Mail::to($email)->send(new AccountRegistration($fname,$username));
            //return back()->with('success','$posCount POS Terminal(s) has been successfuly assigned to $agentNames ');
            return back()->with('success', $posCount . ' POS Terminal(s) have been successfully assigned to ' . $agentNames);

        }else{
            return back()->with('fail','Something went wrong, try again later or contact system admin');
        }

        
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

       // $finfo = new \finfo(FILEINFO_MIME_TYPE);
		 // Save the file locally in the storage/public/ folder under a new folder named /ppts
		 $request->ppt->store('ppts', 'public');

         if ($request->file('ppt')->isValid()) {
            $path = $request->file('ppt')->store('ppts', 'public');
        
            //return $path;
        }

        // Process the other_attachment
        if ($request->hasFile('address_proof')) {
            $request->validate([
                'address_proof' => 'mimes:png,jpg,jpeg|max:2048',
            ]);
            $request->address_proof->store('address', 'public');
        }

         // Process the other_attachment
         if ($request->hasFile('docimage')) {
            $request->validate([
                'docimage' => 'mimes:png,jpg,jpeg|max:2048',
            ]);
            $request->docimage->store('address', 'public');
        }


      $save= DB::table('tbl_agents')->insert([
            'first_name' => $input['fname'],
            'mid_name' => $input['mname'],
            'last_name' => $input['lname'],
            'dob' => $input['birth_date'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'gender' => $input['gender'],
            'location' => $input['location'],
            'country' => $input['country'],
            'bank_name' => $input['bank_name'],
            'bank_acc_no' => $input['bank_acc_no'],
            'status' => 'pending', // Assuming you want to set the default status
            'BVN' => $input['bvn'],
            'doc_type' => $input['doc_type'],
            'doc_no' => $input['doc_no'],
            'passport' => $request->ppt->hashName(),
            'address_proff' => $request->address_proof->hashName(),
            'docimage' => $request->docimage->hashName(),
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

        $input = $request->all();
       // return $input;

        $request->validate([
			'first_name'=>'required',
			//'mname'=>'required',
			'last_name'=>'required',
			'email'=>'required|email|unique:tbl_agents',
			'gender'=>'required',
			'phone'=>'required',
			'bvn'=>'required',
			//'station'=>'required',
			//'id_number'=>'required|unique:clients_data|min:5|max:12'
	   ]);

        if ($request->hasFile('passport')) {

            $request->validate([
                'passport' => 'mimes:png,jpg,jpeg|max:2048' // Only allow .jpg, .bmp and .png file types.
            ]);
    
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
             // Save the file locally in the storage/public/ folder under a new folder named /ppts
             $request->passport->store('ppts', 'public');
        }

          // Process the other_attachment
            if ($request->hasFile('address_proof')) {
                $request->validate([
                    'address_proof' => 'mimes:png,jpg,jpeg|max:2048',
                ]);
                $request->address_proof->store('address', 'public');
            }


            // Process the other_attachment
            if ($request->hasFile('docimage')) {
                $request->validate([
                    'docimage' => 'mimes:png,jpg,jpeg|max:2048',
                ]);
                $request->docimage->store('address', 'public');
            }

        // Store the agent record in the database using DB facade
        $inserted = DB::table('tbl_agents')->insertGetId([
            'first_name' => $input['first_name'],
            'mid_name' => $input['mid_name'],
            'last_name' => $input['last_name'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'dob' => $input['birth_date'],
            'doc_type' => $input['doc_type'],
            'doc_no' => $input['doc_no'],
            'tax_id' => $input['taxid'],
            'bvn' => $input['bvn'],
            'gender' => $input['gender'],
            'location' => $input['state'],
            'country' => $input['city'],
            'agent_code' => $input['refcode'],
            
            'bank_name' => $input['bank_name'],
            'bank_acc_no' => $input['bank_acc_no'],
            'status' => "pending",
            'passport' => $request->passport->hashName(),
            'address_proff' => $request->address_proof->hashName(),
            'docimage' => $request->docimage->hashName(),
            'registration_date' => date('Y-m-d'), // Assuming you want to set the current date
        ]);

       // $inserted = DB::table('tbl_agents')->insert($agentData);

        if ($inserted) {
            
            return back()->with('success','Year Agent data saved successfully!');
        } else {
           
            return back()->with('error','Something went wrong, try again later or contact system admin');
        }
    }

    public function storecompanyselfreg(Request $request)
    {

        $input = $request->all();
       // return $input;

        $request->validate([
			'cname'=>'required',
			//'mname'=>'required',
			//'last_name'=>'required',
			'email'=>'required|email|unique:tbl_agents',
			//'gender'=>'required',
			'phone'=>'required',
			'bvn'=>'required',
			//'station'=>'required',
			//'id_number'=>'required|unique:clients_data|min:5|max:12'
	   ]);

        // if ($request->hasFile('passport')) {

        //     $request->validate([
        //         'passport' => 'mimes:png,jpg,jpeg|max:2048' // Only allow .jpg, .bmp and .png file types.
        //     ]);
    
        //     $finfo = new \finfo(FILEINFO_MIME_TYPE);
        //      // Save the file locally in the storage/public/ folder under a new folder named /ppts
        //      $request->passport->store('ppts', 'public');
        // }

          // Process the other_attachment
            if ($request->hasFile('address_proof')) {
                $request->validate([
                    'address_proof' => 'mimes:png,jpg,jpeg|max:2048',
                ]);
                $request->address_proof->store('address', 'public');
            }



            $docTypes = $request->input('doc_type');
            $docNumbers = $request->input('directordoc');
            $directorBVNs = $request->input('directorBVN');
            $tax_id = $request->input('taxid');
            $cname = $request->input('cname');

            // Assuming you have a "tbl_agents" table in your database
            $insertedIds = [];
            foreach ($docTypes as $key => $docType) {
                $insertedId = DB::table('tbl_company_directors')->insertGetId([
                    'company_names' => $cname,
                    'tax_id' => $tax_id,
                    'doc_type' => $docType,
                    'doc_no' => $docNumbers[$key],
                    'dir_bvn_no' => $directorBVNs[$key],
                    // Add other fields here as needed
                ]);
                $insertedIds[] = $insertedId;
            }





        // Store the agent record in the database using DB facade
        $inserted = DB::table('tbl_agents')->insertGetId([
            'first_name' => $input['cname'],
            //'mid_name' => $input['mid_name'],
            //'last_name' => $input['last_name'],
            'phone' => $input['phone'],
            'email' => $input['email'],
           // 'dob' => $input['birth_date'],
            'agent_type' => $input['agent_type'],
            'agent_role' => "aggregators",
            //'doc_no' => $input['doc_no'],
            'tax_id' => $input['taxid'],
            'bvn' => $input['bvn'],
            //'gender' => $input['gender'],
            'location' => $input['state'],
            'country' => $input['city'],
           // 'bank_name' => $input['bank_name'],
           // 'bank_acc_no' => $input['bank_acc_no'],
            'status' => "pending",
            //'passport' => $request->passport->hashName(),
            'address_proff' => $request->address_proof->hashName(),
            'registration_date' => date('Y-m-d'), // Assuming you want to set the current date
        ]);

       // $inserted = DB::table('tbl_agents')->insert($agentData);

        if ($inserted) {
            
            return back()->with('success','Year Agent data saved successfully!');
        } else {
           
            return back()->with('error','Something went wrong, try again later or contact system admin');
        }
    }

    public function aggregatorstab()
    {
        $aggregators = DB::table('tbl_agents')->where('agent_role','aggregators')->get();

        return view ('agents.aggregatorstable', compact('aggregators'));
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
        $imei = $request->input('imei');
        $device_make = $request->input('device_make');
        $device_model = $request->input('device_model');

        $status="available";
        $owner_type="Store";
        $registration_date= Carbon::now();

        // Insert data into the tbl_pos_terminals table
        DB::table('tbl_pos_terminals')->insert([
            'device_name' => $deviceName,
            'serial_no' => $serialNo,
            'imei' => $imei,
            'device_make' => $device_make,
            'os_version' => $deviceOS,
            'device_model' => $device_model,
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

    public function merchantagentselfregistration()
    {
        return view ('selfregportal.compreg');
        return view ('selfregportal.companyregister');
    }
    public function agentselection()
    {
        return view ('selfregportal.landing');
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

    public function complianceform()
    {
        return view ('agents.complianceform');
    }

    public function complianceformcheck(Request $request, $id)
    {
        
        $status = DB::table('tbl_agents')->where('id', $id)->value('status');
        if ($status && $status !== 'active') {
            // Call your function here
           
        $first_name = DB::table('tbl_agents')->where('id', $id)->value('first_name');
        $mid_name = DB::table('tbl_agents')->where('id', $id)->value('mid_name');
        $last_name = DB::table('tbl_agents')->where('id', $id)->value('last_name');
        $gender = DB::table('tbl_agents')->where('id', $id)->value('gender');
        $status = DB::table('tbl_agents')->where('id', $id)->value('status');
        $BVN = DB::table('tbl_agents')->where('id', $id)->value('BVN');
        $doc_no = DB::table('tbl_agents')->where('id', $id)->value('doc_no');
        $doc_type = DB::table('tbl_agents')->where('id', $id)->value('doc_type');
        $location = DB::table('tbl_agents')->where('id', $id)->value('location');
        $country = DB::table('tbl_agents')->where('id', $id)->value('country');
        $email = DB::table('tbl_agents')->where('id', $id)->value('email');
        $phone = DB::table('tbl_agents')->where('id', $id)->value('phone');
        $passport = DB::table('tbl_agents')->where('id', $id)->value('passport');
        $address_proff = DB::table('tbl_agents')->where('id', $id)->value('address_proff');
        

        $data = [
            'first_name' => $first_name,
            'mid_name' => $mid_name,
            'last_name' => $last_name,
            'gender' => $gender,
            'phone' => $phone,
            'status' => $status,
            'BVN' => $BVN,
            'doc_no' => $doc_no,
            'doc_type' => $doc_type,
            'location' => $location,
            'country' => $country,
            'email' => $email, 
            'passport' => $passport, 
            'address_proff' => $address_proff,
            'agent_id' => $id,         
        ];

        return view ('agents.agentscomplianceform')->with($data);
        }

        $agents = DB::table('tbl_agents')
            ->where('status', '!=', 'approved')
            ->get();


       // return $agents;
        return view ('agents.pendingagentstable', compact('agents'));

       // return view ('agents.agentscomplianceform');

        
    }

    public function approveagent(Request $request)
    {
        $input= $request->all();

        $agentId = $input['agent_id'];
        $approvalDate = $input['approval_Date'];
        $access_pin = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);

        DB::table('tbl_agents')
            ->where('id', $agentId)
            ->update([
                'status' => 'approved',
                'agent_tier_id' => '1',
                'access_pin' => $access_pin ,
                'registration_date' => $approvalDate
            ]);


            // Retrieve agent details from tbl_agents using the agent_id
        $agent = DB::table('tbl_agents')->where('id', $agentId)->first();

        if (!$agent) {
           // return response()->json(['error' => 'Agent not found.'], 404);
            return Redirect::route('complianceagentstab')->with('error', 'an error happened. Reachout to the admins');
        }

        // Create a new user record in users table using agent details
        $userData = [
            'name' => $agent->first_name." ".$agent->mid_name." ".$agent->last_name,
            'username' => $agent->first_name." ".$agent->last_name,
            'mobile_no' => $agent->phone,
            'email' => $agent->email,
            'role' => '0',
            'password' => Hash::make('123456'), // Replace 'your_default_password' with the desired default password
            'email_verified_at' => $approvalDate,
            'created_at' => $approvalDate,
            'updated_at' => $approvalDate,
            // Add any other relevant fields here (e.g., role, status, etc.)
        ];


         // Create a new user record in users table using agent details
         $WalletData = [
            
            'agent_id' => $agentId,
            'wallet_name' => $agent->first_name." ".$agent->mid_name." ".$agent->last_name,
            'wallet_balance' => '0',
            //'created_at' => $approvalDate,
            //'updated_at' => $approvalDate,
        ];

        
        $user = DB::table('users')->where('mobile_no', $agent->phone)->first();
        if ( !$user ){

          // Insert the user data into the users table using the DB facade
            DB::table('users')->insert($userData);
          

        }

        $WalletInfor = DB::table('wallet')->where('agent_id', $agentId)->first();

        if(!$WalletInfor)
        {
            $wallletFormation=DB::table('wallet')->insert($WalletData);
        }
       
        $fname = DB::table('tbl_agents')->where('id', $agentId)->value('first_name');
        $message="Dear $fname,\nYour agent Account has been approved. Use the pin $access_pin to access the app. ";

        $toNumber = DB::table('tbl_agents')->where('id', $agentId)->value('phone');
        //$toNumber="+254728077266";

        $response = $this->sendSMS($toNumber, $message);
       // return $response;

            return Redirect::route('complianceagentstab')->with('success', 'Agent successfully approved. Ready for POS Allocation');
    }



    public function user_profile()
    {
        return view ('agents.userprofile');
    }

    public function ChangeAdminPass()
    {



        return view ('agents.changeAdminPass');
    }

    public function ChangeAgentPass()
    {



        return view ('agents_portal.changeAdminPass');
    }

    public function musicpage()
    {
        return view ('agents.viewmusicpage');
    }

    public function mailtest()
    {
        $mailData = [
            'title' => 'Mail Title',
            'body' => 'This is for testing email using smtp.'
        ];
         
        Mail::to('brianchemo@gmail.com')->send(new DemoMail($mailData));
           
        dd("Email is sent successfully.");
    }

    private function sendSMS(string $toNumber, string $message)
    {
        // Replace these with your actual credentials
        $apiKey = '4e3f3b621a7b0aabb13f1691729e83f0eff6ab05dbaa6173f46d9cc7f6d56dc5';
        $username = "dennis.mwebia";
        $authorization = base64_encode($username . ':' . $apiKey);

        
        // URL to the API endpoint
        $url = 'https://api.africastalking.com/version1/messaging';

        // Request data
        $data = [
            'username' => $username,
            'to' => $toNumber,
            'message' => $message,
           //'from' => 'myShortCode', // Change this if needed
        ];

        
        // Set the API key in the headers
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
            'apiKey' => $apiKey,
        ];

         // Initialize cURL session
        // Create cURL resource
            $ch = curl_init();

            // Set cURL options
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Accept: application/json',
                'Content-Type: application/x-www-form-urlencoded',
                'apiKey: ' . $apiKey
            ));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Execute the cURL request and store the response
            $response = curl_exec($ch);

            // Check for cURL errors
            if (curl_errno($ch)) {
                echo 'cURL error: ' . curl_error($ch);
            }

            // Close cURL resource
            curl_close($ch);

            // Output the response from the API
            echo $response;
    }
}
