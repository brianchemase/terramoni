<?php

namespace App\Http\Controllers;

use App\Models\AgentTier;
use App\Models\AgentType;
use App\Models\Biller;
use App\Models\CommMatrix;
use App\Models\TransactionType;
use App\Models\BillerOffering;
use App\Models\CustomerSegment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CommissionMatrixController extends Controller
{
    
    public function index()
    {
        $commissionMatrix = CommMatrix::all();
        $agents = DB::table('tbl_agents')->where('status', 'approved')->get();
        $agentTypes = AgentType::all();
        $agentTier = AgentTier::all();
        $transactionTypes = TransactionType::all();
        $billers = Biller::all();
        $custSegments = CustomerSegment::all();
        return view('agents.commissionMatrix.index', ['commissionMatrix'=>$commissionMatrix, 'agents'=>$agents, 'agentTypes'=> $agentTypes, 'agentTier'=> $agentTier, 'transactionTypes'=> $transactionTypes, 'billers'=> $billers, 'custSegments'=> $custSegments]);
    }

    public function create()
    {
        $agents = DB::table('tbl_agents')->where('status', 'approved')->get();
    return view('agents.modals.create', compact('agents'));
        
    }

    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'agent_type' => 'required|string',
            'agent_tier_level' => 'nullable|integer',
            'agent_id' => 'nullable|integer',
            'state_id' => 'nullable|string',
            'lga_id' => 'nullable|string',
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

        $request->validate([
            'agent_type' => 'required|string',
            'agent_tier_level' => 'nullable|integer',
            'agent_id' => 'nullable|integer',
            'state_id' => 'nullable|string',
            'lga_id' => 'nullable|string',
            'biller_id' => 'required|integer',
            'transaction_type' => 'nullable|integer',
            'customer_segment_id' => 'required|integer',
            'special_promotion_id' => 'required|integer',
            'min_trans_amount' => 'required|numeric',
            'max_trans_amount' => 'nullable|numeric',
            'commission_rate' => 'required|numeric',
            //'start_time' => 'nullable|date_format:H:i',
        //'end_time' => 'nullable|date_format:H:i',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date',
            
        ]);
        
        $commissionMatrix = CommMatrix::find($cr_id);

        //dd( $commissionMatrix);

        if ($commissionMatrix) {

            $commissionMatrix->agent_type = $request->agent_type;
            $commissionMatrix->agent_tier_level = $request->agent_tier_level;
            $commissionMatrix->agent_id = $request->agent_id;
            $commissionMatrix->state_id = $request->state_id;
            $commissionMatrix->lga_id = $request->lga_id;
            $commissionMatrix->biller_id = $request->biller_id;
            $commissionMatrix->transaction_type = $request->transaction_type;
            $commissionMatrix->customer_segment_id = $request->customer_segment_id;
            $commissionMatrix->special_promotion_id = $request->special_promotion_id;
            $commissionMatrix->min_trans_amount = $request->min_trans_amount;
            $commissionMatrix->max_trans_amount = $request->max_trans_amount;
            $commissionMatrix->commission_rate = $request->commission_rate;
            $commissionMatrix->start_time = $request->start_time;
            $commissionMatrix->end_time = $request->end_time;
            $commissionMatrix->start_date = $request->start_date;
            $commissionMatrix->end_date = $request->end_date;

            //dd( $commissionMatrix);
            $commissionMatrix->save();

            return redirect()->back()->with('success', 'Commission matrix entry updated successfully.');

        }else{
            //dd( $commissionMatrix);
            return redirect()->back()->with('error', 'Commission matrix entry failed. No records found to update');
        }
    }

    public function destroy($cr_id)
    {
        $commissionMatrix = CommMatrix::findOrFail($cr_id);
        $commissionMatrix->delete();

    
    }
    public function basicCommissionMatrix()
{
    $basicCommissionMatrices = CommMatrix::select('cr_id','agent_type', 'agent_tier_level','transaction_type', 'min_trans_amount', 'max_trans_amount','biller_id')->get();

    $agentTypes = AgentType::all();

    $agentTier = AgentTier::all();

    $transactionTypes = TransactionType::all();
    $billers = Biller::all();

    return view('agents.basiccommissionmatrix.index', compact('basicCommissionMatrices','agentTypes','agentTier','transactionTypes','billers'));
}

public function editbasicCommissionMatrix($cr_id)
{
    $basicCommissionMatrix = CommMatrix::findOrFail($cr_id);
    return view('agents.basiccommissionmatrix.edit', compact('basicCommissionMatrix'));
}

public function destroybasicCommissionMatrix($cr_id)
{
    $basicCommissionMatrix = CommMatrix::findOrFail($cr_id);
    $basicCommissionMatrix->delete();
    return redirect()->route('basiccommissionmatrix')->with('success', 'Basic Commission Matrix deleted successfully.');
}

public function storebasicCommissionMatrix(Request $request)
{
    $validator = Validator::make($request->all(), [
        
        'agent_type' => 'required|string|max:255',
        'agent_tier_level' => 'nullable|numeric',
        'transaction_type' => 'nullable|numeric',
        'min_trans_amount' => 'required|numeric',
        'max_trans_amount' => 'nullable|numeric',
        
    ]);

    if ($validator->fails()) {
        return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
    }

    CommMatrix::create($request->all());

    return redirect()->route('basiccommissionmatrix')->with('success', 'Basic Commission Matrix created successfully.');
}

public function updatebasicCommissionMatrix(Request $request, $cr_id)
{
    $basicCommissionMatrix = CommMatrix::findOrFail($cr_id);

    $validator = Validator::make($request->all(), [
        
        'agent_type' => 'required|string|max:255',
        'agent_tier_level' => 'nullable|numeric',
        'transaction_type' => 'nullable|numeric',
        'min_trans_amount' => 'required|numeric',
        'max_trans_amount' => 'nullable|numeric',
        
    ]);

    if ($validator->fails()) {
        return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
    }

    $basicCommissionMatrix->update($request->all());

    return redirect()->route('basiccommissionmatrix')->with('success', 'Basic Commission Matrix updated successfully.');
}

}


