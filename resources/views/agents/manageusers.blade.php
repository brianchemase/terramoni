@extends('agents.inc.master')

@section('title','Manage Users')

@section('content')

<main class="content">
				<div class="container-fluid p-0">

				<h1 class="h3 mb-3"><strong>Users Management</strong> Tab</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Empty card</h5>
								</div>
								<div class="card-body">
								</div>
							</div>
						</div>
					</div>

					<div class="card">
								<div class="card-header">
									<h5 class="card-title">Registered users</h5>
									
								</div>
								<div class="card-body">
									<table id="datatables-buttons" class="table table-striped" style="width:100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Name</th>
												<th>Email</th>
												<th>Phone</th>
												<th>Username</th>
												<th>Role</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										@foreach ($users as $user)
											<tr>
												<td>{{ $loop->iteration }} </td>
												<td>{{ $user->name }}</td>
												<td>{{ $user->email }}</td>
												<td>{{ $user->mobile_no }}</td>
												<td>{{ $user->username }}</td>
																								
												<td>
												@if($user->role == '0')
														<span class="badge bg-success">Agent</span>
													@elseif($user->role == '1')
														<span class="badge bg-danger">Aggregators</span>
													@elseif($user->role == '2')
														<span class="badge bg-warning">Admin</span>
													@endif
												</td>
												<td></td>
											</tr>
										@endforeach
									</tbody>
										
									</table>
								</div>
							</div>

				</div>
				
			</main>
@endsection