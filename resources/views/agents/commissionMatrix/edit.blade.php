@extends('agents.inc.master')

@section('title', 'Edit Commission Matrix')

@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Edit Commission Matrix</h1>

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
                        <h5 class="card-title mb-0"><b>Edit Commission Matrix</b></h5>
                    </div>
                    <div class="card-body">
                        <form class="row g-3" method="POST" action="{{ route('commissionmatrix.update', [$commissionMatrix->cr_id]) }}">
                            @csrf

                            <!-- ROW 1 -->
                            <div class="col-md-4">
                                <label for="agent_type" class="form-label">Agent Type</label>
                                <select class="form-select" id="agent_type" name="agent_type" required>
                                    <option value="" selected disabled>Select Agent Type</option>
                                    @foreach($agentTypes as $agenttype)
                                        <option value="{{ $agenttype->id }}" @if($agenttype->id == $commissionMatrix->agent_type) selected @endif>{{ $agenttype->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-4">
                                <label for="agent_tier_level" class="form-label">Agent Tier Level</label>
                                <select class="form-select" id="agent_tier_level" name="agent_tier_level" required>
                                    <option value="" selected disabled>Select Agent Tier</option>
                                    @foreach($agentTier as $agentier)
                                        <option value="{{ $agentier->tier_id }}" @if($agentier->tier_id == $commissionMatrix->agent_tier_level) selected @endif>{{ $agentier->tier_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            
                            <div class="col-md-4">
                                <label for="agent_id" class="form-label">Agent</label>
                                <select class="form-select" id="agent_id" name="agent_id">
                                    <option value="" selected disabled>Select an Agent</option>
                                    @foreach($agents as $agent)
                                        <option value="{{ $agent->id }}" @if($agent->id == $commissionMatrix->agent_id) selected @endif>{{ $agent->first_name }} {{ $agent->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            

                            <!-- ROW 2 -->
                            <div class="col-md-4">
                                <label for="state_id" class="form-label">State</label>
                                <select onchange="toggleLGA(this);" id="state" class="form-control" name="state_id">
                                    <option value="" selected="selected">- Select -</option>
                                    <option value="Abia">Abia</option>
                                    <option value="Adamawa">Adamawa</option>
                                    <option value="AkwaIbom">AkwaIbom</option>
                                    <option value="Anambra">Anambra</option>
                                    <option value="Bauchi">Bauchi</option>
                                    <option value="Bayelsa">Bayelsa</option>
                                    <option value="Benue">Benue</option>
                                    <option value="Borno">Borno</option>
                                    <option value="Cross River">Cross River</option>
                                    <option value="Delta">Delta</option>
                                    <option value="Ebonyi">Ebonyi</option>
                                    <option value="Edo">Edo</option>
                                    <option value="Ekiti">Ekiti</option>
                                    <option value="Enugu">Enugu</option>
                                    <option value="FCT">FCT</option>
                                    <option value="Gombe">Gombe</option>
                                    <option value="Imo">Imo</option>
                                    <option value="Jigawa">Jigawa</option>
                                    <option value="Kaduna">Kaduna</option>
                                    <option value="Kano">Kano</option>
                                    <option value="Katsina">Katsina</option>
                                    <option value="Kebbi">Kebbi</option>
                                    <option value="Kogi">Kogi</option>
                                    <option value="Kwara">Kwara</option>
                                    <option value="Lagos">Lagos</option>
                                    <option value="Nasarawa">Nasarawa</option>
                                    <option value="Niger">Niger</option>
                                    <option value="Ogun">Ogun</option>
                                    <option value="Ondo">Ondo</option>
                                    <option value="Osun">Osun</option>
                                    <option value="Oyo">Oyo</option>
                                    <option value="Plateau">Plateau</option>
                                    <option value="Rivers">Rivers</option>
                                    <option value="Sokoto">Sokoto</option>
                                    <option value="Taraba">Taraba</option>
                                    <option value="Yobe">Yobe</option>
                                    <option value="Zamfara">Zamafara</option>
                                </select>
                                 <input type="text" class="form-control" id="state" name="state_id" placeholder="Enter State ID"> 
                            </div>
                            <div class="col-md-4">
                                <label for="lga_id" class="form-label">LGA</label>
                                <select id="lga" class="form-control select-lga" name="lga_id" required></select>
                                <input type="text" class="form-control" id="lga" name="lga_id" placeholder="Enter LGA ID">
                            </div>
                            
                            
                            
                            <div class="col-md-4">
                                <label for="biller_id" class="form-label">Biller</label>
                                <select class="form-select" id="biller_id" name="biller_id" required>
                                    <option value="" selected disabled>Select Biller</option>
                                    @foreach($billers as $biller)
                                        <option value="{{ $biller->biller_id }}" @if($biller->biller_id == $commissionMatrix->biller_id) selected @endif>{{ $biller->biller_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- ROW 3 -->
                            <div class="col-md-4">
                                <label for="transaction_type" class="form-label">Transaction Type</label>
                                <select class="form-select" id="transaction_type" name="transaction_type" required>
                                    <option value="" selected disabled>Select Transaction Type</option>
                                    @foreach($transactionTypes as $transactiontype)
                                        <option value="{{ $transactiontype->tt_id }}" @if($transactiontype->tt_id == $commissionMatrix->transaction_type) selected @endif>{{ $transactiontype->tt_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="customer_segment_id" class="form-label">Customer Segment</label>
                                <select class="form-select" id="customer_segment_id" name="customer_segment_id" required>
                                    <option value="" selected disabled>Select Customer Segment</option>
                                    @foreach($custSegments as $custsegment)
                                        <option value="{{ $custsegment->cs_id }}" @if($custsegment->cs_id == $commissionMatrix->customer_segment_id) selected @endif>{{ $custsegment->cs_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-4">
                                <label for="special_promotion_id" class="form-label">Special Promotion</label>
                                <select class="form-select" id="special_promotion_id" name="special_promotion_id" required>
                                    <option value="" selected disabled>Select Special Promotion</option>
                                    @foreach($promotions as $promotion)
                                        <option value="{{ $promotion->promo_id }}" @if($promotion->promo_id == $commissionMatrix->special_promotion_id) selected @endif>{{ $promotion->promo_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            

                            <!-- ROW 4 -->
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
                                <input type="number" step="0.01" class="form-control" id="commission_rate" name="commission_rate" value="{{ $commissionMatrix->commission_rate }}" required>
                            </div>

                            <!-- ROW 5 -->
                            <div class="col-md-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $commissionMatrix->start_date }}">
                            </div>
                            <div class="col-md-3">
                                <label for="start_time" class="form-label">Start Time</label>
                                <input type="time" class="form-control" id="start_time" name="start_time" value="{{ $commissionMatrix->start_time }}">
                            </div>
                            <div class="col-md-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $commissionMatrix->end_date }}">
                            </div>
                            <div class="col-md-3">
                                <label for="end_time" class="form-label">End Time</label>
                                <input type="time" class="form-control" id="end_time" name="end_time" value="{{ $commissionMatrix->end_time }}">
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
