<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerSegment;

class CustomerSegmentController extends Controller
{
    public function index()
    {
        $customerSegments = CustomerSegment::all();
        return view('agents.customerSegments.index', compact('customerSegments'));
    }

    public function create()
    {
        return view('agents.modals.createcustomersegment');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cs_name' => 'required|unique:customer_segment|max:255',
            'cs_notes' => 'nullable|string',
        ]);

        CustomerSegment::create($request->all());

        return redirect()->route('customerSegments')
            ->with('success', 'Customer segment created successfully');
    }

    public function show(CustomerSegment $customerSegment)
    {
        return view('agents.customerSegments.show', compact('customerSegment'));
    }

    public function edit(CustomerSegment $customerSegment)
    {
        return view('agents.customerSegments.edit', compact('customerSegment'));
    }

    public function update(Request $request, CustomerSegment $customerSegment)
    {
        $request->validate([
            'cs_name' => 'required|unique:customer_segment,cs_name,' . $customerSegment->cs_id .',cs_id'. '|max:255',
            'cs_notes' => 'nullable|string',
        ]);

        $customerSegment->update($request->all());

        return redirect()->route('customerSegments')
            ->with('success', 'Customer segment updated successfully');
    }

    public function destroy(CustomerSegment $customerSegment)
    {
        $customerSegment->delete();

        return redirect()->route('customerSegments')
            ->with('success', 'Customer segment deleted successfully');
    }
}
