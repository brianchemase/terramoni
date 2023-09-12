<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    /**
     * Create a new CommissionController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['manageCommissions', 'showCommission']]);
    }
    public function manageCommissions()
    {
        // Fetch all commission data from the tbl_commissions table
        $commissions = DB::table('tbl_commissions')->get();

        return view('agents.commissionstable', ['commissions' => $commissions]);
    }

    public function showCommission($agent_id)
    {
        $totalCommission = DB::table('tbl_commissions')
            ->where('agent_id', $agent_id)
            ->sum('commission');

            $totaltransAmount = DB::table('tbl_transactions')
            ->where('agent_id', $agent_id)
            ->sum('ItemFee');

            $walletvalue="100000";

            $bankWallet=$walletvalue-$totaltransAmount;
            $bankWallet = number_format((float)$bankWallet, 2, '.', '');

            return response()->json([
                'status_code'=> 200,
                'message' => "Wallet history found",
                'total_commission' => $totalCommission, 
                'bankWallet' => $bankWallet
            ]);

       // return response()->json(['total_commission' => $totalCommission, 'bankWallet' => $bankWallet]);
    }
}
