@extends('agents.inc.master')

@section('title','Dashboard')

@section('content')

<main class="content">
				<div class="container-fluid p-0">

				<h1 class="h3 mb-3"><strong>{{$first_name}} {{$last_name}}'s Agent Transactions</strong> Table</h1>

					

					<div class="card">
								<div class="card-header">
									<h5 class="card-title">Table Showing  <b>{{$first_name}} {{$last_name}}'s </b>Agent Transaction(s)</h5>
									
								</div>
								<div class="card-body">
								<table id="datatables-buttons" class="table table-hover my-0">
									<thead>
										<tr>
											<th>#</th>
											<th>Date</th>
											<th>Transaction</th>
											<th class="d-none d-xl-table-cell">Customer</th>
											<th class="d-none d-xl-table-cell">Agent</th>
											
											<th class="d-none d-xl-table-cell">Type</th>
											
											<th>Amount</th>
											
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
									@foreach($transactions as $data)
										<tr>
											<td>{{ $loop->iteration }}</td>
											<td>{{ \Carbon\Carbon::parse($data->transaction_date)->format('jS M Y H:i:s') }} </td>
											<td>{{ $data->customer_reference }} </td>
											
											<td class="d-none d-xl-table-cell">{{ $data->BillerName }}</td>
											<td class="d-none d-xl-table-cell">{{ $data->ConsumerIdField }}</td>
											<td class="d-none d-xl-table-cell">{{ $data->BillerType }}</td>
											<td class="d-none d-xl-table-cell">{{ $data->ItemFee }}</td>
										
											
											<td>
											<a href="{{ url('admins/TransactionData/' . $data->customer_reference) }}" class="btn btn-info"> <i class="fa fa-eye"></i></a>
											<span class="badge bg-success">Successful</span>
                                                <!-- <a href="#" class="btn btn-success"> <i class="align-middle" data-feather="eye"></i></a>
                                                <a href="#" class="btn btn-primary"> <i class="align-middle" data-feather="printer"></i></a>
												 -->
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