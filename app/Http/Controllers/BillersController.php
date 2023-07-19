<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillersController extends Controller
{
    //
    public function billers_data()
    {
    
        $billers = DB::table('tbl_billers_data')->get();

    return response()->json($billers);
       
    }
}
