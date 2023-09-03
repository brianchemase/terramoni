@extends('agents.inc.master')

@section('title','Dashboard')

@section('content')

<main class="content">
				<div class="container-fluid p-0">

				<h1 class="h3 mb-3"><strong>{{$agentnames}}'s POS Terminals</strong> List</h1>
				<p>This is a list of all POS Terminals assigned the agent</p>

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

				

					<div class="card">
								<div class="card-header">
									<h1 class="card-title">POS Terminals List</h1>
									
								</div>
								<div class="card-body">
									<table id="datatables-buttons" class="table table-striped" style="width:100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Device ID</th>
												<th>Device S/N</th>
												<th>Device Make</th>
												<th>Owner Role</th>
												<th>Allocation Date</th>
												<th>Status</th>
												<th>Actions</th>

												
											</tr>
										</thead>
										<tbody>
										@foreach($pos_terminals as $data)
											<tr>
												<td>{{ $loop->iteration }} </td>
												<td>{{ $data->device_name }}  <br> {{ \Carbon\Carbon::parse($data->registration_date)->format('jS M Y') }}</td>
												<td>{{ $data->serial_no }} <br> {{ $data->device_model }}</td>
												<td>{{ $data->device_model }}</td>
												<td>{{ $agentnames }} <br> {{ $data->owner_type }}</td>
												<td>{{ \Carbon\Carbon::parse($data->assignment_date)->format('jS M Y') }}</td>



												<td>
													@if($data->status == 'Assigned')
														<span class="badge bg-success">Active</span>
													@elseif($data->status == 'faulty')
														<span class="badge bg-danger">Faulty</span>
													@elseif($data->status == 'Deactivated')
														<span class="badge bg-warning">Deactivated</span>
													@endif
												

												</td>
												<td> 
													<!-- Default dropleft button -->
														<div class="btn-group dropleft">
															<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															<i class="fa fa-tasks" aria-hidden="true"></i>
															</button>
															<div class="dropdown-menu">
																<!-- Dropdown menu links -->
																<a class="dropdown-item" href="#viewPOS{{$data->id}}" data-toggle="modal">View Details</a>
																@if($data->status != 'Assigned')
																<a class="dropdown-item" href="{{ route('activate_pos', ['serial' => $data->serial_no]) }}">Activate POS Agent</a>
																@endif
																<a class="dropdown-item" href="#suspendpos{{$data->id}}" data-toggle="modal" style="color: red;">Suspend/Reposses</a>		
															</div>
														</div>

														
												</td>
												@include('agents.modals.viewPos')
												
											</tr>
											@endforeach
											
										
										</tbody>
									</table>
								</div>
							</div>

				</div>
				
			</main>
@endsection