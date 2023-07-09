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
