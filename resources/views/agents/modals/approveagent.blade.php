<!-- BEGIN primary modal -->
<div class="modal fade" id="defaultModalPrimary" tabindex="-1" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Approve Agent: {{$first_name}} {{$mid_name}} {{$last_name}}</h5>
				<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
			</div>
			<div class="modal-body m-3">
				
		<form class="row g-3" action="{{route('approveagent')}}" method="post" enctype="multipart/form-data">
		@csrf
			
			

			<div class="col-md-6">
				<label for="validationDefault03" class="form-label"> Approval Date</label>
				<input type="hidden" class="form-control" id="validationDefault03" name="agent_id" placeholder="Enter Phone" value="{{$agent_id}}" required>
				<input type="date" class="form-control" id="validationDefault03" name="approval_Date" placeholder="Enter Phone" required>
			</div>

			
			
	
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Approve Agent</button>
			</div>
		</div>
		</form>
	</div>
</div>
<!-- END primary modal -->


