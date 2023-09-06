@extends('agents.inc.master')

@section('title','Manage Users')

@section('content')

<main class="content">
				<div class="container-fluid p-0">

				<h1 class="h3 mb-3"><strong>Users Management</strong> Tab</h1>

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
									<h5 class="card-title mb-0">Register TerraMoni User</h5>
								</div>
								<div class="card-body">

								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#defaultModalPrimary">
									<i class="fa fa-users" aria-hidden="true"></i> Register Portal User
									</button>
									@include('agents.modals.registeruserportal')
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
													@if($user->role == '2')
														<span class="badge bg-success">Agent</span>
													@elseif($user->role == '3')
														<span class="badge bg-danger">Aggregators</span>
													@elseif($user->role == '1')
														<span class="badge bg-warning">Admin</span>
													@else
														<span class="badge bg-info">Unknown</span>
													@endif
												</td>
												<td>
												<a href="#viewAgentModal{{$user->id}}" title="View Client" data-toggle="modal" class="btn btn-success"><i class="fa fa-eye"></i> </a> 
												<a href="#editUserModal{{$user->id}}" title="Edit User" data-toggle="modal" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                                <a href="#changePasswordModal{{$user->id}}" title="Change Password" data-toggle="modal" class="btn btn-primary"><i class="fa fa-key"></i></a>

												@include('agents.modals.manageusers')


												</td>
											</tr>
										@endforeach
									</tbody>
										
									</table>
								</div>
							</div>

				</div>
				
			</main>
@endsection