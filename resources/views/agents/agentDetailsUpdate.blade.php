@extends('agents.inc.master')

@section('title', 'Agent Update')

@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Agent Update</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><b>Update {{ $agent->first_name }}'s  Details</b></h5>
                    </div>
                    <div class="card-body">
                        <form class="row g-3" method="POST" action="{{ route('update_agent', ['agent_id' => $agent->id]) }}">
                            @csrf
                            @method('PUT')

                            <div class="col-md-4">
                                <label for="first_name" class="form-label">First name*</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $agent->first_name }}" required>
                            </div>
							<div class="col-md-4">
                                <label for="middle_name" class="form-label">Middle name</label>
                                <input type="text" class="form-control" id="mid_name" name="mid_name" value="{{ $agent->mid_name }}">
                            </div>
                            <div class="col-md-4">
                                <label for="last_name" class="form-label">Last name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $agent->last_name }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $agent->phone }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $agent->email }}" required>
                            </div>
							<div class="col-md-4">
                                <label for="bvn" class="form-label">BVN Number</label>
                                <input type="text" class="form-control" id="bvn" name="bvn" value="{{ $agent->BVN }}" required>
                            </div>
							<div class="col-md-4">
                                <label for="tax_id" class="form-label">Tax ID</label>
                                <input type="text" class="form-control" id="tax_id" name="tax_id" value="{{ $agent->tax_id }}">
                            </div>
                            <div class="col-md-5">
							<label for="doc_type" class="form-label">Document Type</label>
							<select class="form-select" id="doc_type" name="doc_type">
								<option value="">Select Document Type</option>
								<option value="Passport" {{ $agent->doc_type === 'Passport' ? 'selected' : '' }}>Passport</option>
								<option value="DL" {{ $agent->doc_type === "DL" ? 'selected' : '' }}>Driver's License</option>
								<option value="NIN" {{ $agent->doc_type === 'NIN' ? 'selected' : '' }}>National ID</option>
								<option value="votersID" {{ $agent->doc_type === 'votersID' ? 'selected' : '' }}>Voters ID</option>
								<!-- Add more options for other document types -->
							</select>
						</div>
                            <div class="col-md-3">
                                <label for="doc_no" class="form-label">Document Number</label>
                                <input type="text" class="form-control" id="doc_no" name="doc_no" value="{{ $agent->doc_no }}">
                            </div>
                            <div class="col-md-6">
                                <label for="bank_name" class="form-label">Bank Name</label>
                                <input type="text" class="form-control" id="bank_name" name="bank_name" value="{{ $agent->bank_name }}">
                            </div>
                            <div class="col-md-6">
                                <label for="bank_acc_no" class="form-label">Bank Account Number</label>
                                <input type="text" class="form-control" id="bank_acc_no" name="bank_acc_no" value="{{ $agent->bank_acc_no }}">
                            </div>
                            <!-- Add more form fields for other agent details -->

                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Update Agent</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection
