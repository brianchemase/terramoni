@extends('agents.inc.master')

@section('title','Dashboard')

@section('content')

<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Assing Aggregator to {{$agentnames}} </strong>Assignment</h1>

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
									<h5 class="card-title">Manager Allocations</h5>
									<h6 class="card-subtitle text-muted">Allocate Aggregator to an Agent.</h6>
								</div>
						<form class="row g-3" action="{{ route('assignmanagers') }}" enctype="multipart/form-data">
							<div class="card-body">
									<div class="mb-3">
											<label for="validationDefault01" class="form-label">Agent Names</label>
											<input type="text" class="form-control" id="validationDefault01" value="{{$agentnames}}">
											<input type="hidden" name="agent_id" class="form-control" id="validationDefault01" value="{{$agent_id}}">
										</div>

								<div class="mb-3">
								<label for="validationDefault04" class="form-label">Available Aggregators for assignment</label>
									<select name="aggregatorid" class="form-control  choices-single">
										<option selected disabled value="">Choose...</option>
												@forelse ($agents as $data)
											<option value="{{ $data->id }}">{{ $data->first_name }} {{ $data->last_name }} - {{ $data->doc_no }}</option>
												@empty
											<option value="" disabled>No Active Agent</option>
												@endforelse
									</select>
								</div>

								
								<br>

								<div class="col-12">
											<button class="btn btn-primary" type="submit">Assign Aggregator</button>
								</div>
							</div>

						</form>
							</div>
						</div>
					</div>

				</div>
			</main>
@endsection