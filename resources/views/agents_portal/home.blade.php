@extends('agents_portal.inc.master')

@section('title','Agents Dashboard')

@section('content')

<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>{{$salutation}}! </strong> Dashboard</h1>
					<h4 class="h4 mb-3"><strong>Hi {{ Auth::user()->name }}, </strong> Welcome to TerraMoni Agents Portal</h4>
					
					
					<div class="col-md-12">
						<div class="row ">
							<div class="col-xl-4 col-lg-6" data-tilt>
								<div class="card l-bg-cherry">
									<div class="card-statistic-3 p-4">
										<div class="card-icon card-icon-large"><i class="fas fa-money-bill-alt"></i></div>
										<div class="mb-4">
											<h5 class="card-title mb-0" style="color: white;">Total Balance</h5>
										</div>
										<div class="row align-items-center mb-2 d-flex">
											<div class="col-8">
												<h2 class="d-flex align-items-center mb-0" style="color: white;">
													NGN {{ number_format($walletBalance) }}
												</h2>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-4 col-lg-6" data-tilt>
								<div class="card l-bg-cherry">
									<div class="card-statistic-3 p-4">
										<div class="card-icon card-icon-large"><i class="fas fa-ticket-alt"></i></div>
										<div class="mb-4">
											<h5 class="card-title mb-0" style="color: white;">Commision Earnings</h5>
										</div>
										<div class="row align-items-center mb-2 d-flex">
											<div class="col-8">
												<h2 class="d-flex align-items-center mb-0" style="color: white;">
													NGN {{ number_format($CommisionEarned, 2) }}
												</h2>
											</div>
											
										</div>
										
									</div>
								</div>
							</div>
							

							

							<div class="col-xl-4 col-lg-6" data-tilt>
								<div class="card l-bg-orange-dark">
									<div class="card-statistic-3 p-4">
										<div class="card-icon card-icon-large"><i class="fas fa-mobile-alt"></i></div>
										<div class="mb-4">
											<h5 class="card-title mb-0" style="color: white;">Allocated POS Terminals</h5>
										</div>
										<div class="row align-items-center mb-2 d-flex">
											<div class="col-8">
												<h2 class="d-flex align-items-center mb-0" style="color: white;">
												{{ number_format($POSCount) }}
												</h2>
											</div>
											
										</div>
										
									</div>
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
											<td>{{ $data->Name }} </td>
											
											<td class="d-none d-xl-table-cell">{{ $data->BillerName }}</td>
											<td class="d-none d-xl-table-cell">{{ $data->ConsumerIdField }}</td>
											<td class="d-none d-xl-table-cell">{{ $data->BillerType }}</td>
											<td class="d-none d-xl-table-cell">{{ $data->ItemFee }}</td>
										
											
											<td>
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