@extends('agents.inc.master')

@section('title','Dashboard')

@section('content')

<main class="content">
				<div class="container-fluid p-0">

				<h1 class="h3 mb-3"><strong>Aggregators</strong> List</h1>
				<p>This is a list of all aggregators</p>

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
									<h5 class="card-title mb-0"></h5>
								</div>
								<div class="card-body">

								<!-- BEGIN primary modal -->
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#defaultModalPrimary">
									<i class="fa fa-tasks" aria-hidden="true"></i> Register Aggregator
									</button>
									@include('agents.modals.registeraggregators')
								
									<!-- END primary modal -->
								</div>
							</div>
						</div>
					</div>

					<div class="card">
								<div class="card-header">
									<h5 class="card-title"><b>Aggregators List</b></h5>
									
								</div>
								<div class="card-body">
								<table id="datatables-buttons" class="table table-striped" style="width:100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Aggregator ID</th>
												<th>Business Name</th>
												<th>Info Details</th>
												<th>Email</th>
												<th>Location</th>
												
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										@foreach($aggregators as $data)
												<tr>
										
												<td>{{ $loop->iteration }} </td>
												<td>{{ $data->doc_no }}  <br> {{ \Carbon\Carbon::parse($data->registration_date)->format('jS M Y') }}</td>
												<td>{{ $data->first_name }} {{ $data->last_name }}</td>
												<td>{{ $data->first_name }} {{ $data->last_name }}<br> {{ $data->phone }}</td>
												<td>{{ $data->email }}</td>
												<td>{{ $data->location }}, {{ $data->country }}</td>
												
												
												<td>
													@if($data->status == 'approved')
														<span class="badge bg-success">Active</span>
													@elseif($data->status == 'suspended')
														<span class="badge bg-danger">Suspended</span>
													@elseif($data->status == 'pending')
														<span class="badge bg-warning">Pending</span>
													@elseif($data->status == 'escalated')
														<span class="badge bg-warning">Escalated</span>
													@else
														<span class="badge bg-info">Unknown</span>
													@endif
												</td>
												<td>
											
												
												
												<div class="dropdown dropleft">
													<a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<i class="align-middle" data-feather="menu"></i>
													</a>

													<div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuLink">
														<a class="dropdown-item" href="#viewAgentModal{{$data->id}}" data-toggle="modal">View Aggegator </a>
														
														<a class="dropdown-item" href="#">Wallet History</a>
														@if($data->status != 'approved')
														<a class="dropdown-item" href="{{ route('complianceagentformpage', ['id' => $data->id]) }}">Approve Agent</a>
														
														@endif
														<a class="dropdown-item" href="#">Assign Acct Mgrs</a>
														<a class="dropdown-item" href="{{ route('agenttrans', ['id' => $data->id]) }}" target="_blank">Transaction History</a>
														<a class="dropdown-item" href="#">Credit Agent Wallet</a>
														<a class="dropdown-item" href="#">Debit Agent Wallet</a>
														<!-- <a class="dropdown-item" href="#">Transactions Rate</a> -->
														<a class="dropdown-item" href="{{ route('agentedit', ['agent_id' => $data->id]) }}" target="_blank">Edit Aggegator details</a>
														<!-- <a class="dropdown-item" href="#">Reset Password</a> -->
														<a class="dropdown-item" href="{{ route('suspend_agent', ['agent_id' => $data->id]) }}" style="color: red;">Suspend Aggegator</a>
													</div>
												</div>
												@include('agents.modals.agentView')
												</td>
											</tr>
											@endforeach
											
											</tr>
										</tbody>
									</table>
								</div>
							</div>

				</div>
				
			</main>
@endsection