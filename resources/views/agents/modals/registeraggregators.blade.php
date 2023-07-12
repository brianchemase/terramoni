<!-- BEGIN primary modal -->
<div class="modal fade" id="defaultModalPrimary" tabindex="-1" aria-hidden="true" style="display: none;">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Register aggregators</h5>
					<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
				</div>
				<div class="modal-body m-3">
					
			<form class="row g-3" action="" method="post" enctype="multipart/form-data">
			@csrf
				<div class="col-md-6">
					<label for="validationDefault01" class="form-label">Company name</label>
					<input type="text" class="form-control" id="validationDefault01" onkeyup="this.value = this.value.toUpperCase();" name="cname" placeholder="Enter Company name" required>
				</div>
				<div class="col-md-6">
					<label for="validationDefault02" class="form-label">Tax ID</label>
					<input type="text" class="form-control" id="validationDefault02" name="mname" onkeyup="this.value = this.value.toUpperCase();" placeholder="Enter TAX ID" >
				</div>
				<div class="col-md-4">
					<label for="validationDefault02" class="form-label">Registration No </label>
					<input type="text" class="form-control" id="validationDefault02" name="lname" onkeyup="this.value = this.value.toUpperCase();" placeholder="Enter Company Registration No" required>
				</div>

				<div class="col-md-4">
					<label for="validationDefault05" class="form-label">BVN No</label>
					<input type="text" class="form-control" id="validationDefault05" name="bvn" placeholder="Enter Valid BVN No" required>
				</div>
				
				<div class="col-md-4">
					<label for="validationDefault03" class="form-label">Operating Licence No</label>
					<input type="text" class="form-control" id="validationDefault03" name="licence_no" placeholder="Enter Operating Licence No" required>
				</div>
				<div class="col-md-4">
					<label for="validationDefault05" class="form-label">Director ID No</label>
					<input type="text" class="form-control" id="validationDefault05" name="id_no" placeholder="Enter Enter Director ID " required>
				</div>
				<div class="col-md-4">
					<label for="validationDefault05" class="form-label">Director Names</label>
					<input type="text" class="form-control" id="validationDefault05" name="id_no" placeholder="Enter Enter Director Name " required>
				</div>

				<div class="col-md-4">
					<label for="validationDefault05" class="form-label">Director Contact</label>
					<input type="text" class="form-control" id="validationDefault05" name="id_no" placeholder="Enter Enter Director Email " required>
				</div>
				<div class="col-md-4">
					<label for="validationDefault03" class="form-label">Company Phone</label>
					<input type="text" class="form-control" id="validationDefault03" name="phone" placeholder="Enter Phone" required>
				</div>
				<div class="col-md-4">
					<label for="validationDefault03" class="form-label">Company Email</label>
					<input type="text" class="form-control" id="validationDefault03" name="email" placeholder="Enter Email" required>
				</div>
				
				
				

				<div class="col-md-4">
					<label for="validationDefault05" class="form-label">Location</label>
					<input type="text" class="form-control" id="validationDefault05" name="location" placeholder="Enter Company's Location" required>
				</div>
				<div class="col-md-4">
					<label for="validationDefault05" class="form-label">Country</label>
					<input type="text" class="form-control" id="validationDefault05" name="country" placeholder="Enter Company's Country" required>
				</div>
				
				<div class="col-md-8">
					<label for="validationDefault04" class="form-label">Bussiness type</label>
					<select class="form-select" id="validationDefault04" name="Business type" required>
						<option selected disabled value="">Choose...</option>
						<option>Private Limited Liability </option>
						<option>Public Limited Liability </option>
						<option>Non-Government Organization </option>
						<option>Proprietor/Partnership</option>
						<option>General Collection </option>
						<option>Starter Business/SMEs</option>
						<option>Betting/Lottery </option>
						<option>Payment/Finance</option>
					</select>
				</div>
				
		
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save Agent</button>
				</div>
			</div>
			</form>
		</div>
	</div>
	<!-- END primary modal -->