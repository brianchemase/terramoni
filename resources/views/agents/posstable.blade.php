@extends('agents.inc.master')

@section('title','Dashboard')

@section('content')

<main class="content">
				<div class="container-fluid p-0">

				<h1 class="h3 mb-3"><strong>POS Terminals</strong> List</h1>
				<p>This is a list of all POS Terminals</p>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Empty card</h5>
								</div>
								<div class="card-body">
									<!-- BEGIN primary modal -->
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#defaultModalPrimary">
										Register POS Terminal
									</button>
									<div class="modal fade" id="defaultModalPrimary" tabindex="-1" aria-hidden="true" style="display: none;">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Register POS Terminal</h5>
													<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
												</div>
												<div class="modal-body m-3">
													<p class="mb-0">Use Bootstrap’s JavaScript modal plugin to add dialogs to your site for lightboxes, user
														notifications, or completely custom content.</p>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
													<button type="button" class="btn btn-primary">Save changes</button>
												</div>
											</div>
										</div>
									</div>
									<!-- END primary modal -->
								</div>
							</div>
						</div>
					</div>

					<div class="card">
								<div class="card-header">
									<h5 class="card-title">POS Terminals List</h5>
									<h6 class="card-subtitle text-muted">This extension provides a framework with common options that can be used with
										DataTables. See official documentation <a href="https://datatables.net/extensions/buttons/" target="_blank"
											rel="noopener noreferrer">here</a>.</h6>
								</div>
								<div class="card-body">
									<table id="datatables-buttons" class="table table-striped" style="width:100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Device ID</th>
												<th>Device S/N</th>
												<th>Device OS</th>
												<th>Owner</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										@foreach($pos_terminals as $data)
											<tr>
											<td>{{ $loop->iteration }} </td>
										
												<td>{{ $data->device_name }}  <br> {{ \Carbon\Carbon::parse($data->registration_date)->format('jS M Y') }}</td>
												<td>{{ $data->serial_no }} <br> {{ $data->device_os }}</td>
												<td>{{ $data->device_os }}</td>
												<td>{{ $data->owner_name }} <br> {{ $data->owner_type }}</td>



												<td>
													@if($data->status == 'Assigned')
														<span class="badge bg-success">Active</span>
													@elseif($data->status == 'faulty')
														<span class="badge bg-danger">Faulty</span>
													@elseif($data->status == 'available')
														<span class="badge bg-warning">Inactive</span>
													@endif
												

												</td>
												<td>
												<a href="#" class="btn btn-success"> <i class="align-middle" data-feather="eye"></i></a>
                                                <a href="#" class="btn btn-primary"> <i class="align-middle" data-feather="printer"></i></a>
												
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