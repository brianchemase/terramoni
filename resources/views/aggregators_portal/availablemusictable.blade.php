@extends('agents.inc.master')

@section('title','Dashboard')

@section('content')

<main class="content">
				<div class="container-fluid p-0">

				<h1 class="h3 mb-3"><strong>Music Box </strong>Available Music</h1>

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
									<h1 class="h3 mb-3"><strong>Available Shared Music</strong></h1>
									<h6 class="card-subtitle text-muted">This extension provides a framework with common options that can be used with
										DataTables. See official documentation <a href="https://datatables.net/extensions/buttons/" target="_blank"
											rel="noopener noreferrer">here</a>.</h6>
								</div>
								<div class="card-body">
									<table id="datatables-reponsive" class="table table-striped" style="width:100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Title</th>
												<th>Composer</th>
												<th>Arranger</th>
												<th>Type</th>
												<th>Uploader</th>
												<th>Upload date</th>
												<th>Download</th>
											</tr>
										</thead>
										<tbody>
										@foreach($data as $record)
											<tr>
												<td>{{ $loop->iteration }}</td>
												<td>{{ $record->title }}</td>
												<td>{{ $record->composer }}</td>
												<td>{{ $record->arranger }}</td>
												<td>{{ $record->type }}</td>
												<td>{{ $record->uploader }}</td>
												<td>{{ \Carbon\Carbon::parse($record->upload_date)->format('d-m-Y') }}</td>
												<td>{{ $record->id }} 
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