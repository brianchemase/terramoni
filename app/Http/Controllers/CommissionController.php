<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommissionController extends Controller
{
    //
    public function showCommission($agent_id)
    {
        $totalCommission = DB::table('tbl_commissions')
            ->where('agent_id', $agent_id)
            ->sum('commission');

            $bankWallet="0";

        return response()->json(['total_commission' => $totalCommission, 'bankWallet' => $bankWallet]);
    }
}
