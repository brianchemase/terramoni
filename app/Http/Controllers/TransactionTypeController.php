<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionType;

class TransactionTypeController extends Controller
{
    public function index()
    {
        $transactionTypes = TransactionType::all();
        return view('agents.transactionTypes.index', compact('transactionTypes'));
    }

    public function create()
    {
        return view('agents.mosals.createtransactiontypes');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tt_name' => 'required|unique:trans_type|max:255',
            'tt_notes' => 'nullable|string',
        ]);

        TransactionType::create($request->all());

        return redirect()->route('transactionTypes')
            ->with('success', 'Transaction type created successfully');
    }

    public function show(TransactionType $transactionType)
    {
        return view('agents.transactionTypes.show', compact('transactionType'));
    }

    public function edit(TransactionType $transactionType)
    {
        return view('agents.transactionTypes.edit', compact('transactionType'));
    }

    public function update(Request $request, TransactionType $transactionType)
    {
        $request->validate([
            'tt_name' => 'required|unique:trans_type,tt_name,' . $transactionType->tt_id .',tt_id'. '|max:255',
            'tt_notes' => 'nullable|string',
        ]);

        $transactionType->update($request->all());

        return redirect()->route('transactionTypes')
            ->with('success', 'Transaction type updated successfully');
    }

    public function destroy(TransactionType $transactionType)
    {
        $transactionType->delete();

        return redirect()->route('transactionTypes')
            ->with('success', 'Transaction type deleted successfully');
    }
}
