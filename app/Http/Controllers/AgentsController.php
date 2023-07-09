<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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

        //count all the agents
        $agentCount = DB::table('tbl_agents')->count();

        $data = [
            'salutation' => $salutation,// salutations
            'agentCount' => $agentCount,// counts number of agents
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
        return view ('agents.blank');
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
			'image' => 'mimes:png,jpg,jpeg|max:2048' // Only allow .jpg, .bmp and .png file types.
		]);


		 // Save the file locally in the storage/public/ folder under a new folder named /ppts
		 $request->ppt->store('ppts', 'public');


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
        

		//Insert data into database
		// $new_client = new ClientsData;
		// $new_client->first_name = $request->fname;
		// $new_client->middle_name = $request->mname;
		// $new_client->last_name = $request->lname;
		// //$new_client->station = $request->station;
		// $new_client->email = $request->email;
		// $new_client->phone = $request->phone;
		// $new_client->gender = $request->gender;
		// $new_client->location = $request->location;
		// $new_client->id_number = $request->id_number;
		// $new_client->passport = $request->ppt->hashName();
		// $save = $new_client->save();


		 if($save){
		   //Mail::to($email)->send(new AccountRegistration($fname,$username));
		   return back()->with('success','New Agent data has been successfuly added');
		 }else{
			 return back()->with('fail','Something went wrong, try again later or contact system admin');
		 }
	   //return $request;
		}
	}

    public function aggregatorstab()
    {
        return view ('agents.aggregatorstable');
    }

    public function postterminalstab()
    {
        return view ('agents.posstable');
    }

    public function upload_attempt()
    {
        return view ('agents.uploadattemptform');
    }

    public function user_profile()
    {
        return view ('agents.userprofile');
    }

    public function musicpage()
    {
        return view ('agents.viewmusicpage');
    }
}
