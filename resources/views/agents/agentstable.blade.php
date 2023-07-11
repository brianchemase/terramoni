@extends('agents.inc.master')

@section('title','Dashboard')

@section('content')

<main class="content">
				<div class="container-fluid p-0">

				<h1 class="h3 mb-3"><strong>Agents</strong> List</h1>
				<p>This is a list of all agents</p>

				@if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <strong>{{ $message }}</strong>
                </div>
				@endif

				@if (count($errors) > 0)
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Agents Registration Tab</h5>
								</div>
								<div class="card-body">
								
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#defaultModalPrimary">
									<i class="fa fa-users" aria-hidden="true"></i> Register Individual Agent
									</button>
									@include('agents.modals.registeragent')
								
								</div>
							</div>
						</div>
					</div>

					<div class="card">
								<div class="card-header">
									<h5 class="card-title"><strong>Agents List</strong></h5>
									
								</div>
								<div class="card-body">
									<table id="datatables-buttons" class="table table-striped" style="width:100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Agent ID</th>
												<th>Agent Details</th>
												<th>Location</th>
												<th>POS</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										@foreach($agents as $data)
												<tr>
										
												<td>{{ $loop->iteration }} </td>
												<td>{{ $data->national_id_no }}  <br> {{ \Carbon\Carbon::parse($data->registration_date)->format('jS M Y') }}</td>
												<td>{{ $data->first_name }} {{ $data->last_name }}<br> {{ $data->phone }}</td>
												<td>{{ $data->location }}, {{ $data->country }}</td>
												<td>Samsung <br> SRN</td>
												<td>
													@if($data->status == 'approved')
														<span class="badge bg-success">Active</span>
													@elseif($data->status == 'suspended')
														<span class="badge bg-danger">Suspended</span>
													@elseif($data->status == 'pending')
														<span class="badge bg-warning">Pending</span>
													@endif
												</td>
												<td>
												<a href="#viewAgentModal{{$data->id}}" title="View Client" data-toggle="modal" class="btn btn-success"><i class="fa fa-eye"></i> </a> 
												
                                                @include('agents.modals.agentView')
												<a href="#" class="btn btn-primary"> <i class="align-middle" data-feather="printer"></i></a>
												
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