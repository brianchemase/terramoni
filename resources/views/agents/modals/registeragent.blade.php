<!-- BEGIN primary modal -->
<div class="modal fade" id="defaultModalPrimary" tabindex="-1" aria-hidden="true" style="display: none;">
										<div class="modal-dialog modal-lg" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Register Agent</h5>
													<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
												</div>
												<div class="modal-body m-3">
													
											<form class="row g-3" action="{{route('saveagentdata')}}" method="post" enctype="multipart/form-data">
											@csrf
												<div class="col-md-4">
													<label for="validationDefault01" class="form-label">First name</label>
													<input type="text" class="form-control" id="validationDefault01" onkeyup="this.value = this.value.toUpperCase();" name="fname" placeholder="Enter First Name" required>
												</div>
												<div class="col-md-4">
													<label for="validationDefault02" class="form-label">Middle name</label>
													<input type="text" class="form-control" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" name="mname" placeholder="Enter Middle Name (optional)" >
												</div>
												<div class="col-md-4">
													<label for="validationDefault02" class="form-label">Last name</label>
													<input type="text" class="form-control" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" name="lname" placeholder="Enter Last Name" required>
												</div>
												
												<div class="col-md-4">
													<label for="validationDefault03" class="form-label">DOB</label>
													<input type="date" class="form-control" id="validationDefault03" name="birth_date" required>
												</div>

												<div class="col-md-4">
													<label for="validationDefault03" class="form-label">Phone</label>
													<input type="text" class="form-control" id="validationDefault03" name="phone" placeholder="Enter Phone" required>
												</div>

												<div class="col-md-4">
													<label for="validationDefault03" class="form-label">Email</label>
													<input type="text" class="form-control" id="validationDefault03" name="email" placeholder="Enter Email" required>
												</div>
												<div class="col-md-4">
													<label for="validationDefault04" class="form-label">Gender</label>
													<select class="form-select" id="validationDefault04" name="gender" required>
														<option selected disabled value="">Choose...</option>
														<option>Male</option>
														<option>Female</option>
													</select>
												</div>
												<div class="col-md-4">
													<label for="validationDefault04" class="form-label">Doc Type</label>
													<select class="form-select" id="validationDefault04" name="doc_type" required>
														<option selected disabled value="">Choose...</option>
														<option value="NIN">NIN</option>
														<option value="DL">Driving Licence</option>
														<option value="VotingCard">Voters Card</option>
														<option value="Passport">International Passport</option>
														
													</select>
												</div>
												<div class="col-md-4">
													<label for="validationDefault05" class="form-label">Doc No</label>
													<input type="text" class="form-control" id="validationDefault05" name="doc_no" placeholder="Enter DOC No" required>
												</div>
												<div class="col-md-4">
													<label for="validationDefault04" class="form-label">Bank Name</label>
													<select class="form-select" id="validationDefault04" name="bank_name" required>
														<option selected disabled value="">Choose...</option>
														<option value="001">Ecobank Nigeria Limited</option>
														<option value="002">Fidelity Bank Plc.</option>
														<option value="003">First Bank of Nigeria Limited</option>
														<option value="004">First City Monument Bank Limited</option>
														
													</select>
												</div>
												<div class="col-md-4">
													<label for="validationDefault05" class="form-label">Bank Acc No</label>
													<input type="text" class="form-control" id="validationDefault05" name="bank_acc_no" onkeyup="this.value = this.value.toUpperCase();" placeholder="Enter Acc No" required>
												</div>
												<div class="col-md-4">
													<label for="validationDefault05" class="form-label">BVN No</label>
													<input type="text" class="form-control" id="validationDefault05" name="bvn" onkeyup="this.value = this.value.toUpperCase();" placeholder="Enter Valid BVN No" required>
												</div>

												<div class="col-md-4">
													<label for="validationDefault05" class="form-label">Location</label>
													<input type="text" class="form-control" id="validationDefault05" name="location" placeholder="Enter Agent Location" required>
												</div>
												<div class="col-md-4">
													<label for="validationDefault05" class="form-label">Country</label>
													<input type="text" class="form-control" id="validationDefault05" name="country" placeholder="Enter Agent's Country" required>
												</div>
												<div class="col-md-4">
													<label for="validationDefault05" class="form-label">Passport Photo</label>
													<input type="file" class="form-control" id="validationDefault05" name="ppt" required>
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