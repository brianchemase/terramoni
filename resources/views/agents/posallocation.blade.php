@extends('agents.inc.master')

@section('title','Dashboard')

@section('content')

<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Agents POS Assignment</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">POS Allocation To Approved Agents</h5>
								</div>
								<div class="card-body">

								<form class="row g-3">

								<div class="col-12">
											<label class="sr-only" for="inlineFormInputGroupUsername2">Username</label>
											<div class="input-group mb-2 mr-sm-6">
												<div class="input-group-text">Agents Available to assign</div>
												<select class="form-select" id="validationDefault04" name="q" required>
													<option selected disabled value="">Choose...</option>
													@forelse ($agents as $data)
													
													<option value="{{ $data->id }},{{ $data->id }}">{{ $data->first_name }} {{ $data->last_name }} - {{ $data->national_id_no }}</option>
													@empty
													<option value="" disabled>No Active Agent</option>
													@endforelse
												</select>
												<!-- <input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Username"> -->
											</div>
										</div>								
										
										<div class="col-md-3">
											<label for="validationDefault04" class="form-label">POS Available for assignment</label>
											<select class="form-select" id="validationDefault04" required>
												<option selected disabled value="">Choose...</option>
												@forelse ($pos_terminals as $data)
													
													<option value="{{ $data->id }}">{{ $data->device_name }} - {{ $data->serial_no }} - {{ $data->device_os }} </option>
													@empty
													<option value="" disabled>No Available POS</option>
													@endforelse
											</select>
										</div>
										
										<div class="col-12">
											<button class="btn btn-primary" type="submit">Assign POS</button>
										</div>
									</form>



									
								</div>
							</div>
						</div>



						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Multiple Allocations</h5>
									<h6 class="card-subtitle text-muted">A vanilla, lightweight, configurable select box/text input plugin.</h6>
								</div>
						<form class="row g-3" action="{{ route('assignagentspos') }}" enctype="multipart/form-data">
							<div class="card-body">
								<div class="mb-3">
								<label for="validationDefault04" class="form-label">Available Agents for assignment</label>
									<select name="agentid" class="form-control  choices-single">
										<option selected disabled value="">Choose...</option>
												@forelse ($agents as $data)
											<option value="{{ $data->id }}">{{ $data->first_name }} {{ $data->last_name }} - {{ $data->national_id_no }}</option>
												@empty
											<option value="" disabled>No Active Agent</option>
												@endforelse
									</select>
								</div>

								<div>
								<label for="validationDefault04" class="form-label">POS Available for assignment</label>
									<select name="posid[]"class="form-control choices-multiple" multiple>
										@forelse ($pos_terminals as $data)		
											<option value="{{ $data->id }}">{{ $data->device_name }} - {{ $data->serial_no }} - {{ $data->device_os }} </option>
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