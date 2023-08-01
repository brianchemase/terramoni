@extends('agents.inc.master')

@section('title','Dashboard')

@section('content')

<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Change password</h1>

					@if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
					<div class="alert-message">
						<strong>{{ $message }}</strong> 
					</div>
				</div>
				@endif

				@if (count($errors) > 0)
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
					<div class="alert-message">
						<strong>
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
						</strong> 
					</div>
				</div>	
				
				@endif

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Enhance Security with Password Change
Our platform now empowers you with added security by allowing you to change your password effortlessly. Take control of your account's safety and protect your valuable data from unauthorized access. With our robust password change feature, you can easily update your credentials and rest assured that your new password is securely hashed in our system. Embrace peace of mind and stay one step ahead of potential threats. Your security matters to us – change your password today and fortify your account!</h5>
								</div>
								<div class="card-body">
								</div>
							</div>
						</div>
					</div>

					<div class="row">
					<div class="col-12">
					<div class="card">
										<div class="card-body">
											<h5 class="card-title">Change Password</h5>

											<form method="POST" action="{{ route('change.password') }}">
											@csrf
												<div class="mb-3">
													<label class="form-label" for="inputPasswordCurrent">Current password</label>
													<input type="password" class="form-control" name="current_password" id="inputPasswordCurrent" required>
													
												</div>
												<div class="mb-3">
													<label class="form-label" for="inputPasswordNew">New password</label>
													<input type="password" class="form-control" name="new_password" id="inputPasswordNew" required>
												</div>
												<div class="mb-3">
													<label class="form-label" for="inputPasswordNew2">Verify password</label>
													<input type="password" class="form-control" name="new_password_confirmation" id="inputPasswordNew2" required>
												</div>
												<button type="submit" class="btn btn-primary">Change Password</button>
											</form>

										</div>
									</div>
									</div>
					</div>

				</div>
			</main>
			@endsection