@extends('agents.inc.master')

@section('title','Dashboard')

@section('content')

<main class="content">
				<div class="container-fluid p-0">

					
					<h1 class="h3 mb-3">KYC Review </h1>

					<div class="row">
						<div class="col-md-4 col-xl-6">
							<div class="card mb-3">
								<div class="card-header">
									<h5 class="card-title mb-0">Details Submitted During Registration</h5>
								</div>
								<div class="card-body text-center">
									<img src="{{ asset('storage/ppts/'.$passport) }}" alt="Passport Photo Missing" class="img-fluid" width="128" height="328" />
									<!-- <img src="{{asset('dash/img/avatars/avatar-4.jpg')}}" alt="Christina Mason" class="img-fluid rounded-circle mb-2" width="128" height="128" /> -->
									<h5 class="card-title mb-0">Agent Names: {{$first_name}} {{$mid_name}} {{$last_name}}</h5>
									<div class="text-muted mb-2">BVN No: {{$BVN }}</div>

												@if($status == 'approved')
														<span class="badge bg-success">Active</span>
													@elseif($status == 'suspended')
														<span class="badge bg-danger">Suspended</span>
													@elseif($status == 'pending')
														<span class="badge bg-warning">Pending</span>
													@endif
								</div>
								
								<hr class="my-0" />
								<div class="card-body">
									
									<ul class="list-unstyled mb-0">
										<li class="mb-1"><span data-feather="play" class="feather-sm mr-1"></span> Name : {{$first_name}} {{$mid_name}} {{$last_name}}</li>
										<li class="mb-1"><span data-feather="play" class="feather-sm mr-1"></span> Birth Date : @if ($dob)
																														
																														{{ \Carbon\Carbon::parse($dob)->format('jS M Y') }}
																													@else
																														Date of Birth Not provided
																													@endif
																													</li>
										<li class="mb-1"><span data-feather="play" class="feather-sm mr-1"></span> BVN No : {{$BVN }}</li>
										<li class="mb-1"><span data-feather="play" class="feather-sm mr-1"></span> Contact :{{$phone}}</li>
										<li class="mb-1"><span data-feather="play" class="feather-sm mr-1"></span> Location : {{$location}}</li>
										<li class="mb-1"><span data-feather="play" class="feather-sm mr-1"></span> Country : {{$country}}</li>
										<li class="mb-1"><span data-feather="play" class="feather-sm mr-1"></span> Doc Type : {{$doc_type}}</li>
										<li class="mb-1"><span data-feather="play" class="feather-sm mr-1"></span> Doc No : {{$doc_no}}</li>
										
									</ul>
								</div>
								<hr class="my-0" />
								<div class="card-body">
									<h5 class="h6 card-title">Document Uploaded</h5>
									<br>
									<div class="col-6 col-md-4 col-lg-4 col-xl-12">
									
													<img src="{{ asset('storage/address/'.$doc_image) }}" width="550" height="50" class="img-fluid pr-2" alt="file Not Uploaded">
									</div>
									<br>

									<h5 class="h6 card-title">Proof of Address</h5>
									<br>
									<div class="col-6 col-md-4 col-lg-4 col-xl-12">
									
													<img src="{{ asset('storage/address/'.$address_proff) }}" width="1250" height="500" class="img-fluid pr-2" alt="Address Not Uploaded">
									</div>

									<div class="card-body" >

									<a href="{{ route('reject_agent', ['agent_id' => $agent_id]) }}" class="btn btn-danger">
											<i class="fa fa-times" aria-hidden="true"></i> Reject Agent
										</a>

										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#defaultModalPrimary">
										<i class="fa fa-check" aria-hidden="true"></i> Approve Agent
										</button>
										@include('agents.modals.approveagent')
									</div>
								
								</div>
							</div>
						</div>
						<div class="col-md-4 col-xl-6">
							<div class="card mb-3">
								<div class="card-header">
									<h5 class="card-title mb-0">Details from KYC Provider (QoreID)</h5>
								</div>
								<div class="card-body text-center">
									<!-- <img src="{{asset('dash/img/avatars/unnamed.jpg')}}" alt="Christina Mason" class="img-fluid mb-2" width="128" height="128" /> -->
									<img src="data:image/jpeg;base64,{{ $respninphoto }}" alt="No photo found" class="img-fluid mb-2" width="128" height="128" />
									
								</div>
								<hr class="my-0" />
								<div class="card-body">
									
									<ul class="list-unstyled mb-0">
										<li class="mb-1"><span data-feather="play" class="feather-sm mr-1"></span> Name : {{$respfirst}} {{$respninmid}} {{$resplast}}</li>
										<li class="mb-1"><span data-feather="play" class="feather-sm mr-1"></span> Birth Date : {{$respnindob }}</li>
										
										<li class="mb-1"><span data-feather="play" class="feather-sm mr-1"></span> Doc Type : {{$doc_type}}</li>
										<li class="mb-1"><span data-feather="play" class="feather-sm mr-1"></span> Doc No : {{$respid}}</li>
									</ul>
								</div>
								<!-- <hr class="my-0" />
								<div class="card-body">
									<h5 class="h6 card-title">Uploads</h5>
									<br>
									<div class="col-6 col-md-4 col-lg-4 col-xl-12">
									
													<img src="{{asset('dash/img/photos/id_card_sample.jpg')}}" width="1250" height="500" class="img-fluid pr-2" alt="Unsplash">
									</div>
								</div> -->
							</div>
						</div>
					</div>
				</div>
			</main>
@endsection