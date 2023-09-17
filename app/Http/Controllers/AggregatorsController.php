<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class AggregatorsController extends Controller
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

        //$transactions = DB::table('tbl_transactions')->get();
        $POSCount = DB::table('tbl_pos_terminals')->count();
       

        $agentCount="0";
        $mobile=Auth::user()->mobile_no;
        $agent_id = DB::table('tbl_agents')->where('phone', $mobile)->value('id');
        $POSCount = DB::table('tbl_pos_terminals')->where('agent_id', $agent_id)->count();

        $transactions = DB::table('tbl_transactions')
        ->orderBy('Id', 'desc')
        ->where('agent_id', $agent_id)
        ->get();
       // return $agent_id;

       $CommisionEarned = DB::table('tbl_commissions')
            ->where('agent_id', $agent_id)
            ->sum('commission');

      // $walletBalance=rand(1, 100000);
       $bankWallet = DB::table('wallet')->orderBy('wallet_id', 'desc')->where('agent_id', $agent_id)->select('wallet_balance')->first()->wallet_balance;
       $walletBalance = number_format((float)$bankWallet, 2, '.', '');
       //$CommisionEarned=rand(1, 10000);


        $data = [
            'salutation' => $salutation,// salutations
            'agentCount' => $agentCount,// counts number of agents
            'POSCount' => $POSCount,// counts number of POS
            'walletBalance' => $walletBalance,// Balance
            'CommisionEarned' => $CommisionEarned,// commision
            'transactions' => $transactions,// Transactions lists
            // Add more data to the array as needed
        ];

        return view ('aggregators_portal.home')->with($data);

    }
    public function allocatedterminals()
    {

        $mobile=Auth::user()->mobile_no;
        $agent_id = DB::table('tbl_agents')->where('phone', $mobile)->value('id');

      //  return $agent_id;

         // Select all records from tbl_pos_terminals where agent_id matches $agent_id
         $pos_terminals = DB::table('tbl_pos_terminals')->where('agent_id', $agent_id)->get();

         // Now you can use the $posTerminals variable as needed
         // For example, you can loop through the records or return them as a JSON response
        // return response()->json($pos_terminals);

         return view ('agents_portal.posstable', compact('pos_terminals'));

    }

    public function assignaggregators($agent_id)
    {

        $first_name = DB::table('tbl_agents')->where('id', $agent_id)->value('first_name');
        $mid_name = DB::table('tbl_agents')->where('id', $agent_id)->value('mid_name');
        $last_name = DB::table('tbl_agents')->where('id', $agent_id)->value('last_name');

        $agentnames=$first_name." ".$last_name;

        $pos_terminals="";

        $agents = DB::table('tbl_agents')
        ->where('status', 'approved')
        ->where('agent_role', 'aggregators')
        ->get();


        return view ('agents.AssignManager', compact('pos_terminals','agentnames','agents', 'agent_id'));

    }

    public function assignAgents(Request $request)
    {
        // Validate the incoming request data, if needed
        $validatedData = $request->validate([
            'agent_id' => 'required',
            'aggregatorid' => 'required',
        ]);

        // Retrieve the form data
        $agentId = $request->input('agent_id');
        $aggregatorId = $request->input('aggregatorid');

        // Use the DB facade to update the tbl_agents table
        DB::table('tbl_agents')
            ->where('id', $agentId)
            ->update(['aggregator_id' => $aggregatorId]);

        // Redirect to another page
        return redirect()->route('agentstab')->with('success', 'Agent assigned to aggregator successfully');
    }


}
