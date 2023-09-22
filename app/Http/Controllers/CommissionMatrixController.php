<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\Agent;
use App\Models\AgentTier;
use App\Models\AgentType;
use App\Models\Biller;
use App\Models\CommMatrix;
use App\Models\Promotion;
use App\Models\TransactionType;
use App\Models\BillerOffering;
use App\Models\CustomerSegment;
use App\Models\Wallet;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

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
        $promotions = Promotion::all();

        $basicCommissionMatrices = CommMatrix::select('cr_id', 'agent_type', 'agent_tier_level', 'transaction_type', 'min_trans_amount', 'max_trans_amount', 'biller_id')->get();

        return view('agents.commissionMatrix.index', ['commissionMatrix' => $commissionMatrix, 'agents' => $agents, 'agentTypes' => $agentTypes, 'agentTier' => $agentTier, 'transactionTypes' => $transactionTypes, 'billers' => $billers, 'custSegments' => $custSegments, 'promotions' => $promotions, 'basicCommissionMatrices' => $basicCommissionMatrices]);
    }

    public function create()
    {
        $agents = DB::table('tbl_agents')->where('status', 'approved')->get();
        return view('agents.modals.create', compact('agents'));
    }

    public function store(Request $request)
    {
        //dd($request);
        //dd($request->all());

        $request->validate([
            'agent_type' => 'required|string',

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


        $agents = DB::table('tbl_agents')->where('status', 'approved')->get();
        $agentTypes = AgentType::all();
        $agentTier = AgentTier::all();
        $transactionTypes = TransactionType::all();
        $billers = Biller::all();
        $custSegments = CustomerSegment::all();
        $promotions = Promotion::all();

        return view('agents.commissionMatrix.edit', compact('commissionMatrix', 'agents', 'agentTypes', 'agentTier', 'transactionTypes', 'billers', 'custSegments', 'promotions'));
    }

    public function update(Request $request, $cr_id)
    {

        $request->validate([
            'agent_type' => 'required|string',

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

            return redirect()->route('commissionmatrix')->with('success', 'Commission matrix entry updated successfully.');
        } else {
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
        $basicCommissionMatrices = CommMatrix::select('cr_id', 'agent_type', 'agent_tier_level', 'transaction_type', 'min_trans_amount', 'max_trans_amount', 'biller_id')->get();

        $agentTypes = AgentType::all();

        $agentTier = AgentTier::all();

        $transactionTypes = TransactionType::all();

        $billers = Biller::all();

        $agents = DB::table('tbl_agents')->where('status', 'approved')->get();

        $custSegments = CustomerSegment::all();

        $promotions = Promotion::all();

        $commissionMatrix = CommMatrix::all();

        return view('agents.basiccommissionmatrix.index', compact('basicCommissionMatrices', 'agentTypes', 'agentTier', 'transactionTypes', 'billers', 'agents', 'custSegments', 'promotions', 'commissionMatrix'));
    }

    public function editbasicCommissionMatrix($cr_id)
    {
        $basicCommissionMatrix = CommMatrix::findOrFail($cr_id);
        $agentTypes = AgentType::all();
        $agentTier = AgentTier::all();
        $transactionTypes = TransactionType::all();
        $billers = Biller::all();
        return view('agents.basiccommissionmatrix.edit', compact('basicCommissionMatrix', 'agentTypes', 'agentTier', 'transactionTypes', 'billers'));
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
    public function applyCommissions1(Request $request)
    {
        // Retrieve transaction details from the request
        $agentType = $request->input('agent_type');
        $transactionType = $request->input('transaction_type');
        $agentId = $request->input('agent_id');
        $agentTier = $request->input('agent_tier');
        $billerId = $request->input('biller_id');
        $walletId = $request->input('wallet_id');
        $transactionAmount = $request->input('transaction_amount');
        $transactionId = $request->input('transaction_id');
        

        $agentTierId = Agent::find($agentId);

        //return response()->json(['message' => $agentTierId->agent_tier_id]);

        if ($agentTierId->agent_tier_id == null || $agentTierId->agent_tier_id == "") {
            return response()->json(['message' => 'No agent tier set for agent.']);
        }

        $commissionAmount = 0;

        // Apply commissions logic based on business rules
        if ($agentType === 'Agent' && ($transactionType === 'Withdrawal' || $transactionType === 'Checkout' || $transactionType === 'Funds Transfer')) {
            // No commission 
            $commissionAmount = 0;
        

         
        } elseif ($agentType === 'Agent') {

            $commissionRate = CommMatrix::where('agent_tier_level',  $agentTierId->agent_tier_id)->select('commission_rate')->first();
            //return response()->json(['Rate' => $commissionRate]);
            if (empty($commissionRate)) {
                return response()->json(['message' => 'Commission has not been set for this tier']);
            } else {
                $commissionAmount = ($commissionRate->commission_rate * $transactionAmount) / 100;
                //dd($commissionAmount);
            }
        }elseif ($agentType === 'Aggregator' ) {
            
            $commissionRate = CommMatrix::where('agent_type', $agentType)
                                          ->where('transaction_type', $transactionType)
                                          ->select('commission_rate')
                                          ->first();
            
            if (empty($commissionRate)) {
                return response()->json(['message' => 'Commission rate not found for Aggregator']);
            } else {
                $commissionAmount = ($commissionRate->commission_rate * $transactionAmount) / 100;
            }
        } elseif( $agentType === 'Terra'){
             $commissionRate = CommMatrix::where('agent_type', $agentType)
                                          ->where('transaction_type', $transactionType)
                                          ->select('commission_rate')
                                          ->first();
            
            if (empty($commissionRate)) {
                return response()->json(['message' => 'Commission rate not found for  Terra']);
            } else {
                $commissionAmount = ($commissionRate->commission_rate * $transactionAmount) / 100;
            }
        }

        

       

        $commission = new Commission();
        $commission->transaction_id = $transactionId;
        $commission->amount = $transactionAmount;
        $commission->commission = $commissionAmount;
        $commission->type = $agentType;
        $commission->date = now();
        $commission->agent_id = $agentId;
        $commission->save();

        return response()->json(['message' => 'Commissions applied successfully', 'commission_amount' => $commissionAmount]);
    }

    public function applyCommissions(Request $request)
    {
        // Retrieve transaction details from the request
        $agentType = $request->input('agent_type');
        $transactionType = $request->input('transaction_type');
        $agentId = $request->input('agent_id');
        $agentTier = $request->input('agent_tier');
        $billerId = $request->input('biller_id');
        $walletId = $request->input('wallet_id');
        $transactionAmount = $request->input('transaction_amount');
        $transactionId = $request->input('transaction_id');


        $agentTierId = Agent::find($agentId);

        //return response()->json(['message' => $agentTierId->agent_tier_id]);

        if ($agentTierId->agent_tier_id == null || $agentTierId->agent_tier_id == "") {
            return response()->json(['message' => 'No agent tier set for agent.']);
        }

        $commissionAmount = 0;
        $commissionAmountAggregator = 0;
        $commissionAmountTerra = 0;

        // Apply commissions logic based on business rules
        if ($agentType === 'Agent' && ($transactionType === 'Withdrawal' || $transactionType === 'Checkout' || $transactionType === 'Funds Transfer')) {
            // No commission 
            $commissionAmount = 0;
        } elseif ($agentType === 'Agent') {

            $commissionRate = CommMatrix::where('agent_tier_level', $agentTierId->agent_tier_id)->select('commission_rate')->first();
            //return response()->json(['Rate' => $commissionRate]);
            if (empty($commissionRate)) {
                return response()->json(['message' => 'Commission has not been set for this tier']);
            } else {
                $commissionAmount = ($commissionRate->commission_rate * $transactionAmount) / 100;
                //dd($commissionAmount);

                $commission = new Commission();
                $commission->transaction_id = $transactionId;
                $commission->amount = $transactionAmount;
                $commission->commission = $commissionAmount;
                $commission->type = $agentType;
                $commission->date = now();
                $commission->agent_id = $agentId;
                $commission->save();

                $commissionRateAggregator = CommMatrix::where('agent_type', '2')
                    ->where('transaction_type', $transactionType)
                    ->select('commission_rate')
                    ->first();
                if (empty($commissionRateAggregator)) {
                    return response()->json(['message' => 'Commission rate not found for Aggregator']);
                } else {
                    $commissionAmountAggregator = ($commissionRate->commission_rate * $transactionAmount) / 100;

                    $commission = new Commission();
                    $commission->transaction_id = $transactionId;
                    $commission->amount = $transactionAmount;
                    $commission->commission = $commissionAmountAggregator;
                    $commission->type = "Aggregator";
                    $commission->date = now();
                    $commission->agent_id = $agentTierId->aggregator_id;
                    $commission->save();
                }

                $commissionRateTerra = CommMatrix::where('agent_type', '3')
                    ->where('transaction_type', $transactionType)
                    ->select('commission_rate')
                    ->first();
                if (empty($commissionRateTerra)) {
                    return response()->json(['message' => 'Commission rate not found for Terra']);
                } else {
                    $commissionAmountTerra = ($commissionRate->commission_rate * $transactionAmount) / 100;

                    $commission = new Commission();
                    $commission->transaction_id = $transactionId;
                    $commission->amount = $transactionAmount;
                    $commission->commission = $commissionAmount;
                    $commission->type = $agentType;
                    $commission->date = now();
                    $commission->agent_id = '0';
                    $commission->save();
                }
            }
        } 
        


        

        return response()->json(['message' => 'Commissions applied successfully', 'commission_amount' => $commissionAmount]);
    }
}
