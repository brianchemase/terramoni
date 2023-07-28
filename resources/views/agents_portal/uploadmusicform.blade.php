@extends('agents.inc.master')

@section('title','Dashboard')

@section('content')

<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Submit My Music Contribution</h1>

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


					<div class="row">
						<div class="col-12">
							
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Form Templete</h5>
									<h5 class="card-subtitle text-muted">If you're not interested in writing JavaScript to change form behaviors. See official
										documentation <a href="https://v5.getbootstrap.com/docs/5.0/forms/validation/#browser-defaults" target="_blank"
											rel="noopener noreferrer">here</a>.</h5>
								</div>
								<div class="card-body">
									<form class="row g-3">
										<div class="col-md-4">
											<label for="validationDefault01" class="form-label">First name</label>
											<input type="text" class="form-control" id="validationDefault01" placeholder="Enter data" required>
										</div>
										<div class="col-md-4">
											<label for="validationDefault02" class="form-label">Last name</label>
											<input type="text" class="form-control" id="validationDefault02" placeholder="Otto" required>
										</div>
										<div class="col-md-4">
											<label for="validationDefaultUsername" class="form-label">Username</label>
											<div class="input-group">
												<span class="input-group-text" id="inputGroupPrepend2">@</span>
												<input type="text" class="form-control" id="validationDefaultUsername" aria-describedby="inputGroupPrepend2"
													required>
											</div>
										</div>
										<div class="col-md-6">
											<label for="validationDefault03" class="form-label">City</label>
											<input type="text" class="form-control" id="validationDefault03" required>
										</div>
										<div class="col-md-3">
											<label for="validationDefault04" class="form-label">State</label>
											<select class="form-select" id="validationDefault04" required>
												<option selected disabled value="">Choose...</option>
												<option>...</option>
											</select>
										</div>
										<div class="col-md-3">
											<label for="validationDefault05" class="form-label">Zip</label>
											<input type="text" class="form-control" id="validationDefault05" required>
										</div>
										<div class="col-12">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
												<label class="form-check-label" for="invalidCheck2">
													Agree to terms and conditions
												</label>
											</div>
										</div>
										<div class="col-12">
											<button class="btn btn-primary" type="submit">Submit form</button>
										</div>
									</form>
								</div>
							</div>

						
						</div>
					</div>

				</div>
			</main>
@endsection