@extends('agents.inc.master')

@section('title','Dashboard')

@section('content')

<main class="content">
				<div class="container-fluid p-0">

				<h1 class="h3 mb-3"><strong>Prime Airtime Transactions</strong> Table</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Place holder card</h5>
								</div>
								<div class="card-body">
								</div>
							</div>
						</div>
					</div>

					<div class="card">
								<div class="card-header">
									<h5 class="card-title">Prime Airtime Table</h5>
									<h6 class="card-subtitle text-muted">Table showing Transactions </h6>
								</div>
								<div class="card-body">
									<table id="datatables-buttons" class="table table-striped" style="width:100%">
										<thead>
											<tr>
											<th>Time</th>
											<th>Account</th>
											<th>Type</th>
											<th>Wallet ID</th>
											<th>Balance After</th>
											<th>Amount</th>
											<th>Currency</th>
											<th>Description</th>
											<th>Source</th>
											<th>ID</th>
											<th>Account Name</th>
											</tr>
										</thead>
										<tbody>
										@foreach ($docs as $doc)
										<tr>
											<td>{{ $doc['time'] }}</td>
											<td>{{ $doc['account'] }}</td>
											<td>{{ $doc['type'] }}</td>
											<td>{{ $doc['wallet_id'] }}</td>
											<td>{{ $doc['balance_after'] }}</td>
											<td>{{ $doc['amount'] }}</td>
											<td>{{ $doc['currency'] }}</td>
											<td>{{ $doc['description'] }}</td>
											<td>{{ $doc['source'] }}</td>
											<td>{{ $doc['_id'] }}</td>
											<td>{{ $doc['account_name'] }}</td>
										</tr>
										@endforeach
										</tbody>
									</table>
								</div>
							</div>

				</div>
				
			</main>
@endsection