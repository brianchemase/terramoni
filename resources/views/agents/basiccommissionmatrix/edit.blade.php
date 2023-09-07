@extends('agents.inc.master')

@section('title', 'Edit Basic Commission Matrix')

@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Edit Basic Commission Matrix</h1>

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
            <div class="alert-message">
                <strong>{{ $message }}</strong>
            </div>
        </div>
        @endif

        @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
            <div class="alert-message">
                <strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </strong>
            </div>
        </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><b>Edit Basic Commission Matrix</b></h5>
                    </div>
                    <div class="card-body">
                        <form class="row g-3" method="POST" action="{{ route('basiccommissionmatrix.update', [$basicCommissionMatrix->cr_id]) }}">
                            @csrf
                            @method('PUT')

                            
                            {{-- <div class="col-md-6">
                                <label for="agent_role" class="form-label">Agent Role</label>
                                <input type="text" class="form-control" id="agent_role" name="agent_role" value="{{ $basicCommissionMatrix->agent_role }}" required>
                            </div> --}}
                            <div class="col-md-6">
                                <label for="agent_type" class="form-label">Agent Type</label>
                                <select class="form-select" id="agent_type" name="agent_type" required>
                                    <option value="" selected disabled>Select Agent Type</option>
                                    @foreach($agentTypes as $agenttype)
                                        <option value="{{ $agenttype->id }}" @if($agenttype->id == $basicCommissionMatrix->agent_type) selected @endif>{{ $agenttype->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="agent_tier_level" class="form-label">Agent Tier Level</label>
                                <select class="form-select" id="agent_tier_level" name="agent_tier_level" required>
                                    <option value="" selected disabled>Select Agent Tier</option>
                                    @foreach($agentTier as $agentier)
                                        <option value="{{ $agentier->tier_id }}" @if($agentier->tier_id == $basicCommissionMatrix->agent_tier_level) selected @endif>{{ $agentier->tier_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="transaction_type" class="form-label">Transaction Type</label>
                                <select class="form-select" id="transaction_type" name="transaction_type" required>
                                    <option value="" selected disabled>Select Transaction Type</option>
                                    @foreach($transactionTypes as $transactiontype)
                                        <option value="{{ $transactiontype->tt_id }}" @if($transactiontype->tt_id == $basicCommissionMatrix->transaction_type) selected @endif>{{ $transactiontype->tt_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="biller_id" class="form-label">Biller</label>
                                <select class="form-select" id="biller_id" name="biller_id" required>
                                    <option value="" selected disabled>Select Biller</option>
                                    @foreach($billers as $biller)
                                        <option value="{{ $biller->biller_id }}" @if($biller->biller_id == $basicCommissionMatrix->biller_id) selected @endif>{{ $biller->biller_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="min_trans_amount" class="form-label">Min Transaction Amount</label>
                                <input type="number" class="form-control" id="min_trans_amount" name="min_trans_amount" value="{{ $basicCommissionMatrix->min_trans_amount }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="max_trans_amount" class="form-label">Max Transaction Amount</label>
                                <input type="number" class="form-control" id="max_trans_amount" name="max_trans_amount" value="{{ $basicCommissionMatrix->max_trans_amount }}">
                            </div>
                            

                            <!-- ROW 5 -->
                            <div class="col-md-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $basicCommissionMatrix->start_date }}">
                            </div>
                            <div class="col-md-3">
                                <label for="start_time" class="form-label">Start Time</label>
                                <input type="time" class="form-control" id="start_time" name="start_time" value="{{ $basicCommissionMatrix->start_time }}">
                            </div>
                            <div class="col-md-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $basicCommissionMatrix->end_date }}">
                            </div>
                            <div class="col-md-3">
                                <label for="end_time" class="form-label">End Time</label>
                                <input type="time" class="form-control" id="end_time" name="end_time" value="{{ $basicCommissionMatrix->end_time }}">
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Update Basic Commission Matrix</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
