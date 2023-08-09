<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function userslist()
    {

        $users = DB::table('users')->get();

       // return $users;

        return view ('agents.manageusers',['users' => $users]);
    }
}
