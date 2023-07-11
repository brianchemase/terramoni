<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="{{asset('clientsdash/img/icons/icon-48x48.png')}}" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

	<title>Verify | SISDO CLIENTS</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="{{asset('clientsdash/css/app.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">OTP Verification</h1>
							<p class="lead">
								Use the otp sent to {{ session('client_phone') }} via SMS to log into the system
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									
									<form action="{{route('validateotp')}}" methot="POST">
									@if(Session::has('success'))
                                                <div class="alert alert-success">{{Session::get('success')}}</div>
                                            @endif
                                            @if(Session::has('fail'))
                                                <div class="alert alert-danger">{{Session::get('fail')}}</div>
                                            @endif
										@csrf
										<div class="mb-3">
											<label class="form-label">Enter OTP</label>
											<input type="hidden" name="client_id" value="{{ session('clientloggingid') }}"> 
											<input class="form-control form-control-lg" type="text" name="OTP" placeholder="Key in your OTP" />
										</div>
										
										
										<div class="text-center mt-3">
											<button type="submit" class="btn btn-lg btn-primary">Verify OTP</button>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

    <script src="{{asset('clientsdash/js/app.js')}}"></script>

</body>

</html>