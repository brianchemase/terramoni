@extends('agents.inc.master')

@section('title','Dashboard')

@section('content')

<main class="content">
				<div class="container-fluid p-0">

				<h1 class="h3 mb-3"><strong>Aggregators</strong> List</h1>
				<p>This is a list of all aggregators</p>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Empty card</h5>
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
									<h5 class="card-title">Aggregators List</h5>
									<h6 class="card-subtitle text-muted">List showing all the aggregators registered </h6>
								</div>
								<div class="card-body">
								<table id="datatables-buttons" class="table table-striped" style="width:100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Aggregator ID</th>
												<th>Bussiness Name</th>
												<th>Info Details</th>
												<th>Email</th>
												<th>Location</th>
												<th>POS</th>
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
												
												<td>Samsung <br> SRN</td>
												<td>
													@if($data->status == 'approved')
														<span class="badge bg-success">Active</span>
													@elseif($data->status == 'suspended')
														<span class="badge bg-danger">Suspended</span>
													@elseif($data->status == 'pending')
														<span class="badge bg-warning">Pending</span>
													@else
														<span class="badge bg-info">Unknown</span>
													@endif
												</td>
												<td>
											
												
												
												<div class="dropdown show">
													<a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<i class="align-middle" data-feather="menu"></i>
													</a>

													<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
														<a class="dropdown-item" href="#viewAgentModal{{$data->id}}" data-toggle="modal">View Aggregator</a>
														<a class="dropdown-item" href="#">DeActivate Agent</a>
														<a class="dropdown-item" href="#">Wallet History</a>
														<a class="dropdown-item" href="#">Assign Acct Mgrs</a>
														<a class="dropdown-item" href="{{ route('agenttrans', ['id' => $data->id]) }}" target="_blank">Transaction History</a>
														<a class="dropdown-item" href="#">Credit Agent Wallet</a>
														<a class="dropdown-item" href="#">Debit Agent Wallet</a>
														<a class="dropdown-item" href="#">Transactions Rate</a>
														<a class="dropdown-item" href="#">Edit Agent details</a>
														<a class="dropdown-item" href="#">Reset Password</a>
														<a class="dropdown-item" href="#" style="color: red;">Block Agent</a>
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