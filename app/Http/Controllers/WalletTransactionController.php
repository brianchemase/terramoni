<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WalletTransactionController extends Controller
{
    //

    public function FundAllocation(Request $request)
    {

        $active_agents = DB::table('tbl_agents')
        ->where('status', 'approved')
        ->where('agent_role', 'agent')
        ->get();

        if(isset($_GET['q']))
        {    
            $agent_id=$_GET['q'];
            $details=$_GET['q'];



            $allocation = DB::table('wallet')->where('agent_id', $agent_id)->first();

            if ($allocation) {
                // Record exists, return its values
                $fund_balance = DB::table('wallet')->orderBy('wallet_id', 'desc')->where('agent_id', $agent_id)->select('wallet_balance')->first()->wallet_balance;

            } else{
                $fund_balance="0";
                //return "No results";
            }
            $results = DB::table('tbl_agents')->where('id', $agent_id)->get();

            $client_fname = DB::table('tbl_agents')->orderBy('id', 'desc')->where('id', $agent_id)->select('first_name')->first()->first_name;
            $client_lname = DB::table('tbl_agents')->orderBy('id', 'desc')->where('id', $agent_id)->select('last_name')->first()->last_name;
            $staff_names=$client_fname." ".$client_lname;



            $data = [
                'fund_balance' => $fund_balance,
                'agent_id' => $agent_id,
                'staff_names' => $staff_names,
                //'data1' => $data1,
                'results' => $results,
                'active_agents' => $active_agents,
                //'staffData' => $staffData,
                // Add more data to the array as needed
            ];
            return view ('agents.agentwalletfunding')->with($data);


        }

       // return $active_agents;


        $data1="0";

        $data = [
            'active_agents' => $active_agents,
           
            // Add more data to the array as needed
        ];
        return view ('agents.agentwalletfunding')->with($data);


    }



    public function allocateFunds(Request $request)
    {
        // Validate the form data
        $request->validate([
            'balance' => 'required|numeric',
            'amounttopup' => 'required|numeric',
            'agent_id' => 'required',
        ]);


         // Get the form input values
         $balance = $request->input('balance');
         $allocated = $request->input('amounttopup');
         $agent_id = $request->input('agent_id');
         $staff_names = $request->input('staff_names');

         $amountToAllocate=$allocated+$balance;


          // Perform the allocation insert
        $insertResult = DB::table('wallet')->insert([
            'agent_id' => $agent_id,
            'wallet_name' => $staff_names,
            'wallet_balance' => $amountToAllocate,
           // 'allocation_date' => $allocationDate,
           // 'allocated_amount' => $amountToAllocate,
        ]);


        if ($insertResult) {
            // Data was successfully inserted
            return redirect()->back()->with('success', 'Funds allocated successfully');
        } else {
            // Error occurred while inserting data
            return redirect()->back()->with('error', 'Failed to allocate funds. Please try again.');
        }


    }
}
