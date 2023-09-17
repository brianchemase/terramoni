<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class AgentsDashboardController extends Controller
{

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

       $walletBalance=rand(1, 100000);
       //$CommisionEarned=rand(1, 10000);
       $totaltransAmount = DB::table('tbl_transactions')
            ->where('agent_id', $agent_id)
            ->sum('ItemFee');

            $walletvalue="100000";
            //check wallet entry
            $walletEntry = DB::table('wallet')->where('agent_id', $agent_id)->first();

            if ($walletEntry) {

                $bankWallet = DB::table('wallet')->orderBy('wallet_id', 'desc')->where('agent_id', $agent_id)->select('wallet_balance')->first()->wallet_balance;

            //$bankWallet=$walletvalue-$totaltransAmount;
                $walletBalance = number_format((float)$bankWallet, 2, '.', '');
            }
            else {
                $walletBalance = 0.00;
            }
            //$bankWallet = DB::table('wallet')->orderBy('wallet_id', 'desc')->where('agent_id', $agent_id)->select('wallet_balance')->first()->wallet_balance;

            //$walletBalance=$walletvalue-$totaltransAmount;
            //$walletBalance = number_format((float)$bankWallet, 2, '.', '');

            // Retrieve data and sum up ItemFee
            $monthlySum = DB::table('tbl_transactions')
            ->where('agent_id', $agent_id) // Add this line to filter by agent_id
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
            'POSCount' => $POSCount,// counts number of POS
            'walletBalance' => $walletBalance,// Balance
            'CommisionEarned' => $CommisionEarned,// commision
            'transactions' => $transactions,// Transactions lists
            'Monthlabels' => $Monthlabels,//monthly data
            'Monthlydata' => $Monthlydata,//monthly data
            // Add more data to the array as needed
        ];

        return view ('agents_portal.home')->with($data);




    }

    public function blank()
    {
        return view ('agents_portal.underconstraction');
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

}
