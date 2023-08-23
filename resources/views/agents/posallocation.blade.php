@extends('agents.inc.master')

@section('title','Dashboard')

@section('content')

<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Agents POS Assignment</h1>

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
									<h5 class="card-title">Multiple Allocations</h5>
									<h6 class="card-subtitle text-muted">Allocate one or multiple POS to an approved agent.</h6>
								</div>
						<form class="row g-3" action="{{ route('assignagentspos') }}" enctype="multipart/form-data">
							<div class="card-body">
								<div class="mb-3">
								<label for="validationDefault04" class="form-label">Available Agents for assignment</label>
									<select name="agentid" class="form-control  choices-single">
										<option selected disabled value="">Choose...</option>
												@forelse ($agents as $data)
											<option value="{{ $data->id }}">{{ $data->first_name }} {{ $data->last_name }} - {{ $data->doc_no }}</option>
												@empty
											<option value="" disabled>No Active Agent</option>
												@endforelse
									</select>
								</div>

								<div>
								<label for="validationDefault04" class="form-label">POS Available for assignment</label>
									<select name="posid[]"class="form-control choices-multiple" multiple>
										@forelse ($pos_terminals as $data)		
											<option value="{{ $data->id }}">{{ $data->device_name }} - {{ $data->serial_no }} - {{ $data->device_model }} </option>
										@empty
											<option value="" disabled>No Available POS</option>
										@endforelse
									</select>
									
								</div>
								<br>

								<div class="col-12">
											<button class="btn btn-primary" type="submit">Assign POS</button>
								</div>
							</div>

						</form>
							</div>
						</div>
					</div>

				</div>
			</main>
@endsection