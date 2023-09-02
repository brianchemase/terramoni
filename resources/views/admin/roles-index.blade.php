@extends('agents.inc.master')

@section('title','Dashboard')

@section('content')

<main class="content">
				<div class="container-fluid p-0">

				<h1 class="h3 mb-3"><strong>All Roles</strong> Table</h1>				

					<div class="card">
								<div class="card-header">
									<h5 class="card-title">Table Showing All Roles(s)</h5>
									
								</div>
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
								<div class="card-body">
								
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createRole">
									<i class="fa fa-users" aria-hidden="true"></i> Create New Role
									</button>
									@include('agents.modals.createrole')
								
								</div>
								<div class="card-body">
								<table id="datatables-buttons" class="table table-hover my-0">
									<thead>
										<tr>
											<th class="d-none d-xl-table-cell">#</th>
											<th class="d-none d-xl-table-cell">Role</th>
											<th class="d-none d-xl-table-cell">Date</th>	
											<th class="d-none d-xl-table-cell">Action</th>										
										</tr>
									</thead>
									<tbody>
									@foreach($Roles as $role)
										<tr>
											<td>{{ $loop->iteration }}</td>											
											<td>{{ $role->name }} </td>
											<td>{{ \Carbon\Carbon::parse($role->created_at)->format('jS M Y H:i:s') }} </td>
											<td><a href="#editRoleModal{{$role->id}}" title="Edit Role" data-toggle="modal" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
											<a href="#" data-id="{{$role->id}}" title="Delete Role" class="btn btn-danger delete-role"><i class="fa fa-trash"></i></a>
										
										</td>
											
											@include('agents.modals.editrole')
										</tr>
										@endforeach							
										
									</tbody>
								</table>
								</div>
							</div>

				</div>
				
			</main>
@endsection