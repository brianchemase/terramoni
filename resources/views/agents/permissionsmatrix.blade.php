@extends('agents.inc.master')

@section('title','Dashboard')

@section('content')

<main class="content">
				<div class="container-fluid p-0">


					<h1 class="h3 mb-3"><strong>Permissions- Access Matrix </strong> </h1>
					<div class="row">
						<div class="col-xl-12">
							<div class="card">
								<div class="card-header pb-0">
									<div class="card-actions float-right">
										<div class="dropdown show">
											<a href="#" data-toggle="dropdown" data-display="static">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal align-middle"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
											</a>

											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="#">Action</a>
												<a class="dropdown-item" href="#">Another action</a>
												<a class="dropdown-item" href="#">Something else here</a>
											</div>
										</div>
									</div>
									<h5 class="card-title mb-0">Permissions Access Matrix</h5>
								</div>
								<div class="card-body">
									<table class="table table-striped" style="width:100%">
										<thead>
											<tr>
												
												<th>Name</th>
												<th>Admin</th>
												<th>Operators</th>
												<th>Account Manager</th>
												<th>Compliance</th>
												<th>Information Technology</th>
												<th>Developer</th>
												<th>Settlement & reconciliation</th>
												
											</tr>
										</thead>
										<tbody>
										@foreach($permissions as $data)
											<tr>
					
												<td>{{ $data->title }}</td>
												<td class="centre"> <input class="form-check-input" type="checkbox" value=""></td>
												<td class="centre"> <input class="form-check-input" type="checkbox" value=""></td>
												<td class="centre"> <input class="form-check-input" type="checkbox" value=""></td>
												<td class="centre"> <input class="form-check-input" type="checkbox" value=""></td>
												<td class="centre"> <input class="form-check-input" type="checkbox" value=""></td>
												<td class="centre"> <input class="form-check-input" type="checkbox" value=""></td>
												<td class="centre"> <input class="form-check-input" type="checkbox" value=""></td>
												
											</tr>
											@endforeach
											
										</tbody>
									</table>
								</div>
							</div>
						</div>

						
					</div>


				</div>
			</main>
@endsection