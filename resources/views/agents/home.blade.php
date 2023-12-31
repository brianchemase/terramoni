@extends('agents.inc.master')

@section('title','Dashboard')

@section('content')

<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>{{$salutation}}! </strong> </h1>
					<h4 class="h4 mb-3"><strong>Hi {{ Auth::user()->name }}, </strong> Welcome to TerraMoni Dashboard</h4>
					
					
					<div class="col-md-12">
						<div class="row ">
							<div class="col-xl-6 col-lg-6" data-tilt>
								<a href="#" style="text-decoration: none;">
								<div class="card l-bg-tera-dark">
									<div class="card-statistic-3 p-4">
										<div class="card-icon card-icon-large"><i class="fas fa-concierge-bell"></i></div>
										<div class="mb-4">
											<h5 class="card-title mb-0" style="color: white;">TerraSwitch Master Wallet</h5>
										</div>
										<div class="row align-items-center mb-2 d-flex">
											<div class="col-12">
												<h4 class="d-flex align-items-center mb-0" style="color: yellow;">
												Balance	NGN {{ number_format($walletBalance) }}
												</h4>
											</div>
											<div class="col-12">
												<h4 class="d-flex align-items-center mb-0" style="color: yellow;">
												Earnings NGN {{ number_format($walletearningBalance) }}
												</h4>
											</div>
										</div>
									</div>
								</div>
								</a>
							</div>
							<div class="col-xl-6 col-lg-6" data-tilt>
								<a href="#" style="text-decoration: none;">
								<div class="card l-bg-cherry">
									<div class="card-statistic-3 p-4">
										<div class="card-icon card-icon-large"><i class="fas fa-money-bill-alt"></i></div>
										<div class="mb-4">
											<h5 class="card-title mb-0" style="color: white;">Master Transaction Summary</h5>
										</div>
										<div class="row align-items-center mb-2 d-flex ">
											<div class="col-12">
												<h4 class="d-flex align-items-center mb-0" style="color: white;">
												Total Count {{ number_format($totalTransactioncount) }}
												</h4>
											</div>
											<div class="col-12">
												<h4 class="d-flex align-items-center mb-0 text-start text-left" style="color: yellow;">
												Total Value NGN {{ number_format($totalTransactionValue) }}
												</h4>
											</div>
										</div>
									</div>
								</div>
								</a>
							</div>
							<div class="col-xl-4 col-lg-6" data-tilt data-tilt-reverse="true">
								<a href="{{ route('agentstab') }}" style="text-decoration: none;">
								<div class="card l-bg-blue-dark">
									<div class="card-statistic-3 p-4">
										<div class="card-icon card-icon-large"><i class="fas fa-users"></i></div>
										<div class="mb-4">
											<h5 class="card-title mb-0" style="color: white;">Agents</h5>
										</div>
										<div class="row align-items-center mb-2 d-flex">
											<div class="col-12">
												<h2 class="d-flex align-items-center mb-1" style="color: white;">
												Total {{ number_format($agentCount) }}
												</h2>
											</div>

											<div class="col-12">
												<h5 class="d-flex align-items-center mb-0" style="color: white;">
												Active {{ number_format($activeAgentsCount) }} || Inactive {{ number_format($inactiveAgentsCount) }} 
												</h5>
											</div>
											
										</div>
										
									</div>
								</div>
								</a>
							</div>
							<div class="col-xl-4 col-lg-6" data-tilt data-tilt-reverse="true">
								<a href="{{ route('aggregatorslist') }}" style="text-decoration: none;">
									<div class="card l-bg-green-dark">
										<div class="card-statistic-3 p-4">
											<div class="card-icon card-icon-large"><i class="fas fa-ticket-alt"></i></div>
											<div class="mb-4">
												<h5 class="card-title mb-0" style="color: white;">Aggregators</h5>
											</div>
											<div class="row align-items-center mb-2 d-flex">
												<div class="col-8">
													<h2 class="d-flex align-items-center mb-1" style="color: white;">
													Total {{ number_format($totalaggregators) }}
													</h2>
												</div>

												<div class="col-12">
													<h5 class="d-flex align-items-center mb-0" style="color: white;">
													Active {{ number_format($activeaggregators) }} || Inactive {{ number_format($inactiveaggregators) }} 
													</h5>
												</div>
												
												
											</div>
											
										</div>
									</div>
								</a>
							</div>
							<div class="col-xl-4 col-lg-6" data-tilt data-tilt-reverse="true">
							<a href="{{ route('posterminalslist') }}" style="text-decoration: none;">
								<div class="card l-bg-orange-dark">
									<div class="card-statistic-3 p-4">
										<div class="card-icon card-icon-large"><i class="fas fa-mobile-alt"></i></div>
										<div class="mb-4">
											<h5 class="card-title mb-0" style="color: white;">POS Terminals</h5>
										</div>
										<div class="row align-items-center mb-2 d-flex">
											<div class="col-8">
												<h2 class="d-flex align-items-center mb-1" style="color: white;">
												{{ number_format($POSCount) }}
												</h2>
											</div>

											<div class="col-12">
												<h5 class="d-flex align-items-center mb-0" style="color: white;">
												Active {{ number_format($assignedPOSCount) }} || Inactive {{ number_format($notassignedPOSCount) }} 
												</h5>
											</div>
											
										</div>
										
									</div>
								</div>
							</a>
							</div>
						</div>
					</div>

					
					<h1 class="h3 mb-3"><strong>Top Performing Agents </strong> </h1>
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
									<h5 class="card-title mb-0">Top Performing Agents</h5>
								</div>
								<div class="card-body">
									<table class="table table-striped" style="width:100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Name</th>
												<th>Business Name</th>
												<th>Email</th>
												<th>Location</th>
												<th>Earning</th>

												<th>Status</th>
											</tr>
										</thead>
										<tbody>
										@foreach($topEarningAgents as $agent)
											<tr>
												<td><img src="{{ asset('storage/ppts/'.$agent->passport) }}" width="32" height="32" class="rounded-circle my-n1" alt="Avatar"></td>
												<td>{{ $agent->first_name }} {{ $agent->last_name }}</td>
												<td>{{ $agent->first_name }} {{ $agent->last_name }}</td>
												<td>{{ $agent->email }}</td>
												<td>{{ $agent->location }}</td>
												<td>NRN {{ $agent->earnings }}</td>
												
												<td>
													@if($agent->status == 'approved')
														<span class="badge bg-success">Active</span>
													@elseif($agent->status == 'suspended')
														<span class="badge bg-danger">Suspended</span>
													@elseif($agent->status == 'pending')
														<span class="badge bg-warning">Pending</span>
													@else
														<span class="badge bg-info">Unknown</span>
													@endif
												</td>
											</tr>
											@endforeach

										</tbody>
									</table>
								</div>
							</div>
						</div>

						
					</div>

			


					<h1 class="h3 mb-3"><strong>Transaction Report </strong> </h1>

					<div class="row">
						<div class="col-12 col-lg-12 d-flex">
							<div class="card flex-fill w-100">
								<div class="card-header">
									<div class="card-actions float-right">
										<div class="dropdown show">
											<a href="#" data-toggle="dropdown" data-display="static">
												<i class="align-middle" data-feather="more-horizontal"></i>
											</a>

											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="#">Action</a>
												<a class="dropdown-item" href="#">Another action</a>
												<a class="dropdown-item" href="#">Something else here</a>
											</div>
										</div>
									</div>
									<h5 class="card-title mb-0">Transaction Report</h5>
								</div>
								<div class="card-body py-3">
									<div class="chart chart-md">
										<canvas id="chart-transaction-line"></canvas>
									</div>
								</div>
							</div>
						</div>
					</div>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var ctx = document.getElementById("chart-transaction-line").getContext("2d");
			var gradient = ctx.createLinearGradient(0, 0, 0, 225);
			gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
			gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
			// Line chart
			new Chart(document.getElementById("chart-transaction-line"), {
				type: "line",
				data: {
					labels: {!! json_encode($Monthlabels) !!},
					datasets: [{
						label: "NGN ",
						fill: true,
						backgroundColor: gradient,
						borderColor: window.theme.primary,
						data: {!! json_encode($Monthlydata) !!}
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					tooltips: {
						intersect: false
					},
					hover: {
						intersect: true
					},
					plugins: {
						filler: {
							propagate: false
						}
					},
					scales: {
						xAxes: [{
							reverse: true,
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}],
						yAxes: [{
							ticks: {
								stepSize: 1000
							},
							display: true,
							borderDash: [3, 3],
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}]
					}
				}
			});
		});
	</script>


					<h1 class="h3 mb-3"><strong>Transaction List </strong> </h1>

					<div class="row">
						<div class="col-12 col-lg-12 col-xxl-12 d-flex">
							<div class="card flex-fill">
								<div class="card-header">

									<h5 class="card-title mb-0">Transaction Details Available</h5>
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
						
					</div>

				</div>
			</main>
@endsection