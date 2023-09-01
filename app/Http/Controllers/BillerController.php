<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biller;
use Illuminate\Support\Facades\DB;

class BillerController extends Controller
{
    public function index()
    {
        $billers = Biller::all();
        $billerCategories= DB::table('biller_category')->get();
        return view('agents.billers.index', compact('billers','billerCategories'));
    }

    public function create()
    {
        return view('agents.modals.createbillers');
    }

    public function store(Request $request)
    {
        $request->validate([
            'biller_cat_id' => 'required',
            'biller_code' => 'required|unique:biller',
            'biller_name' => 'required',
            'biller_url' => 'nullable|url',
            'biller_note' => 'nullable',
            
        ]);

        Biller::create($request->all());

        return redirect()->route('billers')
            ->with('success', 'Biller created successfully');
    }

    public function show(Biller $biller)
    {
        return view('agents.billers.show', compact('biller'));
    }

    public function edit(Biller $biller)
    {
        return view('agents.billers.edit', compact('biller'));
    }

    public function update(Request $request, Biller $biller)
    {
        $request->validate([
            'biller_cat_id' => 'required',
            'biller_code' => 'required|unique:biller,biller_code,' . $biller->biller_id . ',biller_id',
            'biller_name' => 'required',
            'biller_url' => 'nullable|url',
            'biller_note' => 'nullable',
            
        ]);

        $biller->update($request->all());

        return redirect()->route('billers')
            ->with('success', 'Biller updated successfully');
    }

    public function destroy(Biller $biller)
    {
        $biller->delete();

        return redirect()->route('billers')
            ->with('success', 'Biller deleted successfully');
    }
}
