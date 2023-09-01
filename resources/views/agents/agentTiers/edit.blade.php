@extends('agents.inc.master')

@section('title', 'Edit Agent Tier')

@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Edit Agent Tier</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><b>Edit Agent Tier</b></h5>
                    </div>
                    <div class="card-body">
                        <form class="row g-3" method="POST" action="{{ route('agentTiers.update', [$agentTier->tier_id]) }}">
                            @csrf
                            @method('PUT')

                            <!-- ROW 1 -->
                            <div class="col-md-6">
                                <label for="tier_name" class="form-label">Tier Name</label>
                                <input type="text" class="form-control" id="tier_name" name="tier_name" value="{{ $agentTier->tier_name }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="tier_notes" class="form-label">Tier Notes</label>
                                <input type="text" class="form-control" id="tier_notes" name="tier_notes" value="{{ $agentTier->tier_notes }}">
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Update Agent Tier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection
