<?php

namespace App\Http\Controllers;

use App\Models\CommMatrix;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CommissionMatrixController extends Controller
{
    
    public function index()
    {
        $commissionMatrix = CommMatrix::all();
        $agents = DB::table('tbl_agents')->where('status', 'approved')->get();
        return view('agents.commissionMatrix.index', ['commissionMatrix'=>$commissionMatrix, 'agents'=>$agents]);
    }

    public function create()
    {
        $agents = DB::table('tbl_agents')->where('status', 'approved')->get();
    return view('agents.modals.create', compact('agents'));
        
    }

    public function store(Request $request)
    {
        // 
        $request->validate([
            'agent_type' => 'required|string',
            'agent_tier_level' => 'nullable|integer',
            'agent_id' => 'nullable|integer',
            'state_id' => 'nullable|integer',
            'lga_id' => 'nullable|integer',
            'biller_id' => 'required|integer',
            'transaction_type' => 'nullable|integer',
            'customer_segment_id' => 'required|integer',
            'special_promotion_id' => 'required|integer',
            'min_trans_amount' => 'required|numeric',
            'max_trans_amount' => 'nullable|numeric',
            'start_time' => 'nullable|date_format:H:i',
    'end_time' => 'nullable|date_format:H:i',
    'start_date' => 'nullable|date',
    'end_date' => 'nullable|date',

   
            
            
        ]);
        
    
        CommMatrix::create($request->all());
       
        return redirect()->route('commissionmatrix')->with('success', 'Commission matrix entry created successfully.');
    }

    public function edit($cr_id)
    {
        $commissionMatrix = CommMatrix::findOrFail($cr_id);
        return view('agents.commissionMatrix.edit', compact('commissionMatrix'));
    }

    public function update(Request $request, $cr_id)
    {
        $commissionMatrix = CommMatrix::findOrFail($cr_id);

    $request->validate([
        'agent_type' => 'required|string',
        'agent_tier_level' => 'nullable|integer',
        'agent_id' => 'nullable|integer',
        'state_id' => 'nullable|integer',
        'lga_id' => 'nullable|integer',
        'biller_id' => 'required|integer',
        'transaction_type' => 'nullable|integer',
        'customer_segment_id' => 'required|integer',
        'special_promotion_id' => 'required|integer',
        'min_trans_amount' => 'required|numeric',
        'max_trans_amount' => 'nullable|numeric',
        'commission_rate' => 'required|numeric',
        'start_time' => 'nullable|date_format:H:i',
    'end_time' => 'nullable|date_format:H:i',
    'start_date' => 'nullable|date',
    'end_date' => 'nullable|date',
        
    ]);

    $commissionMatrix->update($request->all());

    return redirect()->route('commissionmatrix')->with('success', 'Commission Matrix updated successfully');
    }

    public function destroy($cr_id)
    {
        $commissionMatrix = CommMatrix::findOrFail($cr_id);
        $commissionMatrix->delete();

        return redirect()->route('commissionmatrix')->with('success', 'Commission matrix entry deleted successfully.');
    }
}


