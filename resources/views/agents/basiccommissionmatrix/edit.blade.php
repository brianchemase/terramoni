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

                            <!-- Basic Commission Matrix Fields -->
                            {{-- <div class="col-md-6">
                                <label for="agent_role" class="form-label">Agent Role</label>
                                <input type="text" class="form-control" id="agent_role" name="agent_role" value="{{ $basicCommissionMatrix->agent_role }}" required>
                            </div> --}}
                            <div class="col-md-6">
                                <label for="agent_type" class="form-label">Agent Type</label>
                                <input type="text" class="form-control" id="agent_type" name="agent_type" value="{{ $basicCommissionMatrix->agent_type }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="agent_tier_level" class="form-label">Agent Tier Level</label>
                                <input type="number" class="form-control" id="agent_tier_level" name="agent_tier_level" value="{{ $basicCommissionMatrix->agent_tier_level }}">
                            </div>
                            <div class="col-md-6">
                                <label for="transaction_type" class="form-label">Transaction Type</label>
                                <input type="number" class="form-control" id="transaction_type" name="transaction_type" value="{{ $basicCommissionMatrix->transaction_type }}">
                            </div>
                            <div class="col-md-6">
                                <label for="min_trans_amount" class="form-label">Min Transaction Amount</label>
                                <input type="number" class="form-control" id="min_trans_amount" name="min_trans_amount" value="{{ $basicCommissionMatrix->min_trans_amount }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="max_trans_amount" class="form-label">Max Transaction Amount</label>
                                <input type="number" class="form-control" id="max_trans_amount" name="max_trans_amount" value="{{ $basicCommissionMatrix->max_trans_amount }}">
                            </div>
                            <!-- Additional fields specific to the basic commission matrix can be added here -->

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
