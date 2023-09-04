<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::all();
        return view('agents.promotions.index', compact('promotions'));
    }

    public function create()
    {
        return view('agents.modals.createpromotion');
    }

    public function store(Request $request)
    {
        $request->validate([
            'promo_name' => 'required|string|max:255',
            'promo_notes' => 'nullable|string',
            'promo_start_date' => 'required|date',
            'promo_end_date' => 'required|date',
           
        ]);

        Promotion::create($request->all());

        return redirect()->route('promotions')->with('success', 'Promotion created successfully.');
    }

    public function edit($id)
    {
        $promotion = Promotion::find($id);
        return view('agents.promotions.edit', compact('promotion'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'promo_name' => 'required|string|max:255',
            'promo_notes' => 'nullable|string',
            'promo_start_date' => 'required|date',
            'promo_end_date' => 'required|date',
            
        ]);

        $promotion = Promotion::find($id);
        $promotion->update($request->all());

        return redirect()->route('promotions')->with('success', 'Promotion updated successfully.');
    }

    public function destroy($id)
    {
        $promotion = Promotion::find($id);
        $promotion->delete();

        return redirect()->route('promotions')->with('success', 'Promotion deleted successfully.');
    }
}
