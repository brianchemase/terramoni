<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgentType;

class AgentTypeController extends Controller
{
    public function index()
    {
        $agentTypes = AgentType::all();
        return view('agents.agentTypes.index', compact('agentTypes'));
    }

    public function create()
    {
        return view('agents.modals.createagenttypes');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:agent_type|max:255',
            // Add validation rules for other fields as needed
        ]);

        AgentType::create($request->all());

        return redirect()->route('agentTypes')
            ->with('success', 'Agent type created successfully');
    }

    public function show(AgentType $agentType)
    {
        return view('agents.agentTypes.show', compact('agentType'));
    }

    public function edit(AgentType $agentType)
    {
        return view('agents.agentTypes.edit', compact('agentType'));
    }

    public function update(Request $request, AgentType $agentType)
    {
        $request->validate([
            'name' => 'required|unique:agent_type,name,' . $agentType->id .',id'. '|max:255',
            // Add validation rules for other fields as needed
        ]);

        $agentType->update($request->all());

        return redirect()->route('agentTypes')
            ->with('success', 'Agent type updated successfully');
    }

    public function destroy(AgentType $agentType)
    {
        $agentType->delete();

        return redirect()->route('agentTypes')
            ->with('success', 'Agent type deleted successfully');
    }
}
