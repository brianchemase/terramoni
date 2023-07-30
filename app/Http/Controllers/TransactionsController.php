<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionsController extends Controller
{
    //
    public function transactions($agent_id)
    {
         // Perform the database query to fetch the transaction history for the given agent_id
         $transactionHistory = DB::table('tbl_transactions')
         ->where('agent_id', $agent_id)
         ->get();

     // Return the JSON response with the results
     return response()->json($transactionHistory);
    }
}
