<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
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

            $bankWallet="0";

        return response()->json(['total_commission' => $totalCommission, 'bankWallet' => $bankWallet]);
    }
}
