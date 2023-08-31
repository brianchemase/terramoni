<!-- BEGIN primary modal -->
<div class="modal fade" id="createPermission" tabindex="-1" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">New Permission</h5>
						<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
					</div>
				<div class="modal-body m-3">
						
				<form class="row g-3" action="{{route('CreatePermission')}}" method="post"autocomplete="off">
				@csrf
					<div class="col-md-4">
						<label for="validationDefault01" class="form-label">Permission Name</label>
						<input type="text" class="form-control" id="validationDefault01" name="permission_name" id="permissionid" placeholder="Enter Permission Name" required>
					</div>					
			
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save Permission</button>
					</div>
				</div>
				</form>
			</div>
		</div>
		<!-- END primary modal -->