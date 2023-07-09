@extends('agents.inc.master')

@section('title','Dashboard')

@section('content')

<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>{{$salutation}}! </strong> Dashboard</h1>
					<h4 class="h4 mb-3"><strong>Hi USername, </strong> Welcome to TerraMoni</h4>
					

					<div class="row">
						<div class="col-sm-6 col-xl-3">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Total Transactions</h5>
										</div>

										<div class="col-auto">
											<div class="avatar">
												<div class="avatar-title rounded-circle bg-primary-light">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign align-middle"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
												</div>
											</div>
										</div>
									</div>
								
									<h1 class="mt-1 mb-3">NGN 16,500</h1>
									<div class="mb-0">
										<span class="text-muted"><a href="#">View More</a></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-xl-3">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Total Agents</h5>
										</div>

													<div class="col-auto">
														<div class="avatar">
															<div class="avatar-title rounded-circle bg-primary-light">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users align-middle"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
															</div>
														</div>
													</div>
									</div>
								
									<h1 class="mt-1 mb-3"> {{ number_format($agentCount) }}</h1>
									<div class="mb-0">
										<span class="text-muted"><a href="{{route('agentstab')}}">View More</a></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-xl-3">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Total Aggregators</h5>
										</div>

										<div class="col-auto">
											<div class="avatar">
												<div class="avatar-title rounded-circle bg-primary-light">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users align-middle"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
												</div>
											</div>
										</div>
									</div>
									<h1 class="mt-1 mb-3">1400</h1>
									
									<div class="mb-0">
										
										<span class="text-muted"><a href="{{route('aggregatorslist')}}">View More</a></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-xl-3">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Total POS Terminals</h5>
										</div>

										<div class="col-auto">
											<div class="avatar">
												<div class="avatar-title rounded-circle bg-primary-light">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-smartphone align-middle"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
												</div>
											</div>
										</div>
									</div>
								
									<h1 class="mt-1 mb-3">600</h1>
									<div class="mb-0">
										
										<span class="text-muted"><a href="{{route('posterminalslist')}}">View More</a></span>
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
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "NGN ",
						fill: true,
						backgroundColor: gradient,
						borderColor: window.theme.primary,
						data: [
							2115,
							1562,
							1584,
							1892,
							1587,
							1923,
							2566,
							2448,
							2805,
							3438,
							2917,
							3327
						]
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

									<h5 class="card-title mb-0">Loan Details Available</h5>
								</div>
								<div class="card-body">
								<table id="datatables-buttons" class="table table-hover my-0">
									<thead>
										<tr>
											<th>#</th>
											<th>Transaction</th>
											<th class="d-none d-xl-table-cell">Customer</th>
											<th class="d-none d-xl-table-cell">Agent</th>
											
											<th class="d-none d-xl-table-cell">Type</th>
											
											<th>Amount</th>
											
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>Project Apollo</td>
											<td class="d-none d-xl-table-cell">01/01/2021</td>
											<td class="d-none d-xl-table-cell">31/06/2021</td>
											<td class="d-none d-xl-table-cell">15,000</td>
											<td class="d-none d-xl-table-cell">15,000</td>
										
											
											<td>
											<span class="badge bg-success">Successful</span>
                                                <a href="#" class="btn btn-success"> <i class="align-middle" data-feather="eye"></i></a>
                                                <a href="#" class="btn btn-primary"> <i class="align-middle" data-feather="printer"></i></a>
												
											</td>
										</tr>
										<tr>
											<td>2</td>
											<td>Project Fireball</td>
											<td class="d-none d-xl-table-cell">01/01/2021</td>
											<td class="d-none d-xl-table-cell">31/06/2021</td>
											<td class="d-none d-xl-table-cell">15,000</td>
											<td class="d-none d-xl-table-cell">15,000</td>
									
											<td>
											<span class="badge bg-danger">Cancelled</span>
                                                <a href="#" class="btn btn-success"> <i class="align-middle" data-feather="eye"></i></a>
                                                <a href="#" class="btn btn-primary"> <i class="align-middle" data-feather="printer"></i></a>
												
											</td>
										</tr>
										
										<tr>
											<td>3</td>
											<td>Project Nitro</td>
											<td class="d-none d-xl-table-cell">01/01/2021</td>
											<td class="d-none d-xl-table-cell">31/06/2021</td>
											<td class="d-none d-xl-table-cell">15,000</td>
											<td class="d-none d-xl-table-cell">15,000</td>
			
											<td>
											<span class="badge bg-warning">Processing</span>
                                                <a href="#" class="btn btn-success"> <i class="align-middle" data-feather="eye"></i></a>
                                                <a href="#" class="btn btn-primary"> <i class="align-middle" data-feather="printer"></i></a>
												
											</td>
										</tr>
										
										
									</tbody>
								</table>
								</div>
							</div>
						</div>
						
					</div>

				</div>
			</main>
@endsection