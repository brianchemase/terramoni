<!-- BEGIN primary modal -->
<div class="modal fade" id="createRole" tabindex="-1" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">New Role</h5>
						<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
					</div>
				<div class="modal-body m-3">
						
				<form class="row g-3" action="{{route('CreateRole')}}" method="post" enctype="multipart/form-data" autocomplete="off">
				@csrf
					<div class="col-md-4">
						<label for="validationDefault01" class="form-label">Role Name</label>
						<input type="text" class="form-control" id="validationDefault01" onkeyup="this.value = this.value.toUpperCase();" name="role_name" placeholder="Enter Role Name" required>
					</div>					
			
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save Role</button>
					</div>
				</div>
				</form>
			</div>
		</div>
		<!-- END primary modal -->