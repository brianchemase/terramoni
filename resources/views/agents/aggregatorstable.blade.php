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
										Register Aggregators
									</button>
									<div class="modal fade" id="defaultModalPrimary" tabindex="-1" aria-hidden="true" style="display: none;">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Register aggregators</h5>
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
									<h5 class="card-title">Aggregators List</h5>
									<h6 class="card-subtitle text-muted">This extension provides a framework with common options that can be used with
										DataTables. See official documentation <a href="https://datatables.net/extensions/buttons/" target="_blank"
											rel="noopener noreferrer">here</a>.</h6>
								</div>
								<div class="card-body">
									<table id="datatables-buttons" class="table table-striped" style="width:100%">
										<thead>
											<tr>
												<th>Aggregators ID</th>
												<th>Aggregators Details</th>
												<th>Location</th>
												<th>POS</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<tr>
												<td>Tiger Nixon <br> 18th July 2023</td>
												<td>System Architect <br> Phone</td>
												<td>Edinburgh, Country</td>
												<td>Samsung <br> SRN</td>
												<td><span class="badge bg-danger">Suspended</span></td>
												<td>
												<a href="#" class="btn btn-success"> <i class="align-middle" data-feather="eye"></i></a>
                                                <a href="#" class="btn btn-primary"> <i class="align-middle" data-feather="printer"></i></a>
												
												</td>
											</tr>
											<tr>
												<td>Garrett Winters</td>
												<td>Accountant</td>
												<td>Tokyo</td>
												<td>63</td>
												<td><span class="badge bg-success">Active</span></td>
												<td>
												<a href="#" class="btn btn-success"> <i class="align-middle" data-feather="eye"></i></a>
                                                <a href="#" class="btn btn-primary"> <i class="align-middle" data-feather="printer"></i></a>
												
												</td>
											</tr>
											<tr>
												<td>Ashton Cox</td>
												<td>Junior Technical Author</td>
												<td>San Francisco</td>
												<td>66</td>
												<td><span class="badge bg-info">Inactive</span></td>
												<td>
												<a href="#" class="btn btn-success"> <i class="align-middle" data-feather="eye"></i></a>
                                                <a href="#" class="btn btn-primary"> <i class="align-middle" data-feather="printer"></i></a>
												
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>

				</div>
				
			</main>
@endsection