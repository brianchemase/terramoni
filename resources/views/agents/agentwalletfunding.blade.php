@extends('agents.inc.master')

@section('title','Dashboard')

@section('content')

<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Agent Fund Allocation </h1>

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
					<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Get Agent To Topup</h5>
									<h6 class="card-subtitle text-muted">Select Agent for Fund allocation.</h6>
								</div>
								<div class="card-body">
									<form class="row row-cols-md-auto align-items-center" action="{{route('fundallocations')}}" method="GET" autocomplete="off">
										

										<div class="col-12">
											<label class="sr-only" for="inlineFormInputGroupUsername2">Username</label>
											<div class="input-group mb-2 mr-sm-6">
												<div class="input-group-text">Select Agent</div>
												<select class="form-select" id="validationDefault04" name="q" required>
													<option selected disabled value="">Select...</option>
													@forelse ($active_agents as $data)
													<option value="{{ $data->id }}">{{ $data->first_name }}  {{ $data->last_name }}- {{ $data->doc_no }}</option>
													@empty
													<option value="" disabled>No Active Agent</option>
													@endforelse
												</select>
												<!-- <input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Username"> -->
											</div>
										</div>

										

										<div class="col-12">
											<button type="submit" class="btn btn-primary mb-2">Fetch Agent Details</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>

					@if(isset($results))

					<div class="row">
						<div class="col-12">
							
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Credit Funds To Agent <strong>{{$staff_names}}</strong></h5>
									
								</div>
								<div class="card-body">
									<form class="row g-3" method="POST" action="{{ route('allocate.funds') }}">
                                        @csrf
										<div class="col-md-4">
											<label for="validationDefault01" class="form-label">Current Balance</label>
											<input type="number" class="form-control" id="validationDefault01" value="{{$fund_balance}}" disabled>
                                            <input type="hidden" class="form-control" id="validationDefault01" name="balance" value="{{$fund_balance}}">
                                            <input type="hidden" class="form-control" id="validationDefault01" name="agent_id" value="{{$agent_id}}">
                                            <input type="hidden" class="form-control" id="validationDefault01" name="staff_names" value="{{$staff_names}}">
										</div>
										<div class="col-md-4">
											<label for="validationDefault02" class="form-label">Amount to Allocate </label>
											<input type="number" class="form-control" id="validationDefault02" name="amounttopup" placeholder="Allocate Fund" required>
										</div>
										
										<div class="col-md-4">
											<label for="validationDefaultUsername" class="form-label">Agent/Aggregator/Account Manager ID</label>
											<div class="input-group">
												<span class="input-group-text" id="inputGroupPrepend2">@</span>
												<input type="text" class="form-control" id="validationDefaultUsername" aria-describedby="inputGroupPrepend2" value="{{$agent_id}}" required>
											</div>
										</div>
										
										<div class="col-12">
											<button class="btn btn-primary" type="submit">Allocate Funds</button>
										</div>
									</form>
								</div>
							</div>

						
						</div>
					</div>

					@endif

					

				</div>
			</main>
@endsection