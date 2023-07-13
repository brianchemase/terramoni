@extends('agents.inc.master')

@section('title','Dashboard')

@section('content')

<main class="content">
				<div class="container-fluid p-0">

					
					<h1 class="h3 mb-3">Compliance Check</h1>

					<div class="row">
						<div class="col-md-4 col-xl-6">
							<div class="card mb-3">
								<div class="card-header">
									<h5 class="card-title mb-0">Client Details</h5>
								</div>
								<div class="card-body text-center">
									<img src="{{asset('dash/img/avatars/avatar-4.jpg')}}" alt="Christina Mason" class="img-fluid rounded-circle mb-2" width="128" height="128" />
									<h5 class="card-title mb-0">Client Names</h5>
									<div class="text-muted mb-2">Location</div>

									
								</div>
								
								<hr class="my-0" />
								<div class="card-body">
									<h5 class="h6 card-title">Shared Details</h5>
									<ul class="list-unstyled mb-0">
										<li class="mb-1"><span data-feather="play" class="feather-sm mr-1"></span> Name <a href="#">Name</a></li>
										<li class="mb-1"><span data-feather="play" class="feather-sm mr-1"></span> BVN No <a href="#">BVN No</a></li>
										<li class="mb-1"><span data-feather="play" class="feather-sm mr-1"></span> Contact <a href="#">Contact</a></li>
										<li class="mb-1"><span data-feather="play" class="feather-sm mr-1"></span> Location <a href="#">Location</a></li>
										<li class="mb-1"><span data-feather="play" class="feather-sm mr-1"></span> Country <a href="#">Country</a></li>
										<li class="mb-1"><span data-feather="play" class="feather-sm mr-1"></span> ID No <a href="#">12333</a></li>
										<li class="mb-1"><span data-feather="play" class="feather-sm mr-1"></span> Title <a href="#">Title</a></li>
									</ul>
								</div>
								<hr class="my-0" />
								<div class="card-body">
									<h5 class="h6 card-title">Uploads</h5>
									<br>
									<div class="col-6 col-md-4 col-lg-4 col-xl-12">
									
													<img src="{{asset('dash/img/photos/id_card_sample.jpg')}}" width="1250" height="500" class="img-fluid pr-2" alt="Unsplash">
									</div>
								
								</div>
							</div>
						</div>
						<div class="col-md-4 col-xl-6">
							<div class="card mb-3">
								<div class="card-header">
									<h5 class="card-title mb-0">KYC Details</h5>
								</div>
								<div class="card-body text-center">
									<img src="{{asset('dash/img/avatars/avatar-4.jpg')}}" alt="Christina Mason" class="img-fluid rounded-circle mb-2" width="128" height="128" />
									<h5 class="card-title mb-0">Client Names</h5>
									<div class="text-muted mb-2">Location</div>

									
								</div>
								
								<hr class="my-0" />
								<div class="card-body">
									<h5 class="h6 card-title">Shared Details</h5>
									<ul class="list-unstyled mb-0">
										<li class="mb-1"><span data-feather="play" class="feather-sm mr-1"></span> Name <a href="#">Name</a></li>
										<li class="mb-1"><span data-feather="play" class="feather-sm mr-1"></span> BVN No <a href="#">BVN No</a></li>
										<li class="mb-1"><span data-feather="play" class="feather-sm mr-1"></span> Contact <a href="#">Contact</a></li>
										<li class="mb-1"><span data-feather="play" class="feather-sm mr-1"></span> Location <a href="#">Location</a></li>
										<li class="mb-1"><span data-feather="play" class="feather-sm mr-1"></span> Country <a href="#">Country</a></li>
										<li class="mb-1"><span data-feather="play" class="feather-sm mr-1"></span> ID No <a href="#">12333</a></li>
										<li class="mb-1"><span data-feather="play" class="feather-sm mr-1"></span> Title <a href="#">Title</a></li>
									</ul>
								</div>
								<hr class="my-0" />
								<div class="card-body">
									<h5 class="h6 card-title">Uploads</h5>
									<br>
									<div class="col-6 col-md-4 col-lg-4 col-xl-12">
									
													<img src="{{asset('dash/img/photos/holder.png')}}" width="1250" height="500" class="img-fluid pr-2" alt="Unsplash">
									</div>
								
								</div>
							</div>
						</div>

						
					</div>


				</div>
			</main>
@endsection