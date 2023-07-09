<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgentsController extends Controller
{
    //
    public function dashboard()
    {

        return view ('agents.home');
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
        return view ('agents.agentstable');
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
