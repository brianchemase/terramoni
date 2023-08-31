@extends('agents.inc.master')

@section('title', 'Edit Commission Matrix')

@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Edit Commission Matrix</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><b>Edit Commission Matrix</b></h5>
                    </div>
                    <div class="card-body">
                        <form class="row g-3" method="POST" action="{{ route('commissionmatrix.update', [$commissionMatrix->cr_id]) }}">
                            @csrf
                            
                            <div class="col-md-4">
                                <label for="agent_type" class="form-label">Agent Type</label>
                                <input type="text" class="form-control" id="agent_type" name="agent_type" value="{{ $commissionMatrix->agent_type }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="agent_tier_level" class="form-label">Agent Tier Level</label>
                                <input type="number" class="form-control" id="agent_tier_level" name="agent_tier_level" value="{{ $commissionMatrix->agent_tier_level }}">
                            </div>
                            <div class="col-md-4">
                                <label for="agent_id" class="form-label">Agent ID</label>
                                <input type="number" class="form-control" id="agent_id" name="agent_id" value="{{ $commissionMatrix->agent_id }}">
                            </div>
                            <div class="col-md-4">
                                <label for="state_id" class="form-label">State ID</label>
                                <input type="number" class="form-control" id="state_id" name="state_id" value="{{ $commissionMatrix->state_id }}">
                            </div>
                            <div class="col-md-4">
                                <label for="lga_id" class="form-label">LGA ID</label>
                                <input type="number" class="form-control" id="lga_id" name="lga_id" value="{{ $commissionMatrix->lga_id }}">
                            </div>
                            <div class="col-md-4">
                                <label for="biller_id" class="form-label">Biller ID</label>
                                <input type="number" class="form-control" id="biller_id" name="biller_id" value="{{ $commissionMatrix->biller_id }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="transaction_type" class="form-label">Transaction Type</label>
                                <input type="number" class="form-control" id="transaction_type" name="transaction_type" value="{{ $commissionMatrix->transaction_type }}">
                            </div>
                            <div class="col-md-4">
                                <label for="customer_segment_id" class="form-label">Customer Segment ID</label>
                                <input type="number" class="form-control" id="customer_segment_id" name="customer_segment_id" value="{{ $commissionMatrix->customer_segment_id }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="special_promotion_id" class="form-label">Special Promotion ID</label>
                                <input type="number" class="form-control" id="special_promotion_id" name="special_promotion_id" value="{{ $commissionMatrix->special_promotion_id }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="min_trans_amount" class="form-label">Min Transaction Amount</label>
                                <input type="number" class="form-control" id="min_trans_amount" name="min_trans_amount" value="{{ $commissionMatrix->min_trans_amount }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="max_trans_amount" class="form-label">Max Transaction Amount</label>
                                <input type="number" class="form-control" id="max_trans_amount" name="max_trans_amount" value="{{ $commissionMatrix->max_trans_amount }}">
                            </div>
                            <div class="col-md-4">
                                <label for="commission_rate" class="form-label">Commission Rate</label>
                                <input type="number" class="form-control" id="commission_rate" name="commission_rate" value="{{ $commissionMatrix->commission_rate }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="start_time" class="form-label">Start Time</label>
                                <input type="time" class="form-control" id="start_time" name="start_time" value="{{ $commissionMatrix->start_time }}">
                            </div>
                            <div class="col-md-4">
                                <label for="end_time" class="form-label">End Time</label>
                                <input type="time" class="form-control" id="end_time" name="end_time" value="{{ $commissionMatrix->end_time }}">
                            </div>
                            <div class="col-md-4">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $commissionMatrix->start_date }}">
                            </div>
                            <div class="col-md-4">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $commissionMatrix->end_date }}">
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Update Commission Matrix</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection
