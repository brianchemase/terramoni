@extends('agents.inc.master')

@section('title','Dashboard')

@section('content')

<main class="content">
<div class="container-fluid p-0">

<h1 class="h3 mb-3">View Music Page</h1>

<div class="row">
	<div class="col-md-4 col-xl-5">
		<div class="card mb-3">
			<div class="card-header">
				<h5 class="card-title mb-0">Music Details</h5>
			</div>
			<div class="card-body text-center">
				<img src="dash/img/avatars/avatar-4.jpg" alt="Christina Mason" class="img-fluid rounded-circle mb-2" width="128" height="128">
				<h5 class="card-title mb-0">Uploader Name</h5>
				<div class="text-muted mb-2">County</div>

				
			</div>
			
			<hr class="my-0">
			<div class="card-body">
				<h5 class="h6 card-title">Details</h5>
				<ul class="list-unstyled mb-0">
					<li class="mb-1"><span class="fa fa-music fa-fw mr-1"></span> Title: </li>
					<li class="mb-1"><span class="fa fa-user fa-fw mr-1"></span> Composer:</li>
					<li class="mb-1"><span class="fa fa-user-tag fa-fw mr-1"></span> Arranger:</li>
					<li class="mb-1"><span class="fa fa-sign fa-fw mr-1"></span> Type:</li>
					<li class="mb-1"><span class="fa fa-play fa-fw mr-1"></span> Year: </li>
				</ul>
			</div>
			<hr class="my-0">
			<div class="card-body">
			<h5 class="h6 card-title"><strong> Videos Attempt</strong></h5>

			<iframe width="450" height="300"
			src="https://www.youtube.com/embed/vkP3krBJlvg">
		
			</iframe>
						
			</div>
		</div>
	</div>

			<div class="col-md-6 col-xl-7">
				<div class="card">
					<div class="card-header">

						<h5 class="card-title mb-0">Activities</h5>
					</div>
					<iframe src="{{ url('temp/file.pdf') }}" frameborder="0" height="700px" width="100%"></iframe>
				</div>
			</div>
		</div>

		</div>
</main>
@endsection