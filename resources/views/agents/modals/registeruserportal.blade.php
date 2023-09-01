<!-- BEGIN primary modal -->
<div class="modal fade" id="defaultModalPrimary" tabindex="-1" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Register Agent</h5>
						<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
					</div>
				<div class="modal-body m-3">
						
				<form class="row g-3" action="{{route('register_user')}}" method="post" enctype="multipart/form-data" autocomplete="off">
				@csrf
					<div class="col-md-6">
						<label for="validationDefault01" class="form-label">Names</label>
						<input type="text" class="form-control" id="validationDefault01" onkeyup="this.value = this.value.toUpperCase();" name="name" placeholder="Enter Full Names" required>
					</div>

					<div class="col-md-6">
						<label for="validationDefault03" class="form-label">Email</label>
						<input type="text" class="form-control" id="validationDefault03" name="email" placeholder="Enter Email" required>
					</div>
					
									

					<div class="col-md-6">
						<label for="validationDefault03" class="form-label">Phone</label>
						<input type="text" class="form-control" id="validationDefault03" name="phone" placeholder="Enter Phone" required>
					</div>

					<div class="col-md-6">
						<label for="validationDefault01" class="form-label">Usernames</label>
						<input type="text" class="form-control" id="validationDefault01" onkeyup="this.value = this.value.toUpperCase();" name="username" placeholder="Enter First Name" required>
					</div>

					
					<div class="col-md-6">
						<label for="validationDefault04" class="form-label">Role</label>
						<select class="form-select" id="validationDefault04" name="role" required>
						<option selected disabled value="">Choose...</option>
						@foreach ($roles as $role)
							<option value="{{ $role->id }}">
								{{ $role->name }}
							</option>
						@endforeach
						</select>
					</div>
					
					<div class="col-md-12">
						<label for="validationDefault05" class="form-label">Password</label>
						<input type="password" class="form-control" id="validationDefault05" name="password" placeholder="Enter password" required>
					</div>

					<div class="col-md-12">
						<label for="validationDefault05" class="form-label">Confirm Password </label>
						<input type="password" class="form-control" id="validationDefault05" name="password_confirmation" placeholder="Enter password" required>
					</div>
					
			
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Register User</button>
					</div>
				</div>
				</form>
			</div>
		</div>
		<!-- END primary modal -->


