<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgentTier;

class AgentTierController extends Controller
{
    public function index()
    {
        $agentTiers = AgentTier::all();
        return view('agents.agentTiers.index', compact('agentTiers'));
    }

    public function create()
    {
        return view('agents.modals.createagenttiers');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tier_name' => 'required|unique:agent_tier|max:255',
            'tier_notes' => 'nullable|string',
            // Add validation rules for other fields as needed
        ]);

        AgentTier::create($request->all());

        return redirect()->route('agentTiers')
            ->with('success', 'Agent Tier created successfully');
    }

    public function show(AgentTier $agentTier)
    {
        return view('agents.agentTiers.show', compact('agentTier'));
    }

    public function edit(AgentTier $agentTier)
    {
        return view('agents.agentTiers.edit', compact('agentTier'));
    }

    public function update(Request $request, AgentTier $agentTier)
    {
        $request->validate([
            'tier_name' => 'required|unique:agent_tier,tier_name,' . $agentTier->tier_id . ',tier_id'.'|max:255',
            'tier_notes' => 'nullable|string',
            // Add validation rules for other fields as needed
        ]);

        $agentTier->update($request->all());

        return redirect()->route('agentTiers')
            ->with('success', 'Agent Tier updated successfully');
    }

    public function destroy(AgentTier $agentTier)
    {
        $agentTier->delete();

        return redirect()->route('agentTiers')
            ->with('success', 'Agent Tier deleted successfully');
    }
}
