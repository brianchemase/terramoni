<!-- BEGIN primary modal -->
<div class="modal fade" id="defaultModalPrimary" tabindex="-1" aria-hidden="true" style="display: none;">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Register POS</h5>
					<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
				</div>
				<div class="modal-body m-3">
					
			<form class="row g-3" action="{{route('saveposdata')}}" method="post" enctype="multipart/form-data">
			@csrf
				<div class="col-md-4">
					<label for="validationDefault01" class="form-label">Device name</label>
					<input type="text" class="form-control" id="validationDefault01" onkeyup="this.value = this.value.toUpperCase();" name="device_name" placeholder="Enter Device Name" required>
				</div>
				<div class="col-md-4">
					<label for="validationDefault02" class="form-label">Device Model No</label>
					<input type="text" class="form-control" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" name="device_model" placeholder="Enter Device Serial No" >
				</div>
				<div class="col-md-4">
					<label for="validationDefault02" class="form-label">Serial No</label>
					<input type="text" class="form-control" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" name="serialno" placeholder="Enter Device Serial No" >
				</div>

				<div class="col-md-4">
					<label for="validationDefault02" class="form-label">IMEI No</label>
					<input type="text" class="form-control" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" name="imei" placeholder="Enter Device IMEI No" >
				</div>

				<div class="col-md-4">
					<label for="validationDefault02" class="form-label">Device Make</label>
					<input type="text" class="form-control" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" name="device_make" placeholder="Enter Device Make" >
				</div>
				
				<div class="col-md-4">
				<label for="validationDefault05" class="form-label">Device Operating System</label>
				<select class="form-select" id="validationDefault05" name="device_os" required>
					<option selected disabled value="">Choose...</option>
					<option value="Android 12">Android 12</option>
					<option value="Android 11">Android 11</option>
					<option value="Android 10">Android 10</option>
					<option value="Android 9 (Pie)">Android 9 (Pie)</option>
					<option value="Android 8 (Oreo)">Android 8 (Oreo)</option>
					<option value="Android 7 (Nougat)">Android 7 (Nougat)</option>
					<option value="Android 6 (Marshmallow)">Android 6 (Marshmallow)</option>
					<option value="Android 5 (Lollipop)">Android 5 (Lollipop)</option>
					<option value="Android 4.4 (KitKat)">Android 4.4 (KitKat)</option>
					<option value="Android 4.1 - 4.3 (Jelly Bean)">Android 4.1 - 4.3 (Jelly Bean)</option>
					<option value="Android 4.0 (Ice Cream Sandwich)">Android 4.0 (Ice Cream Sandwich)</option>
					<option value="Android 3.0 - 3.2 (Honeycomb)">Android 3.0 - 3.2 (Honeycomb)</option>
					<option value="Android 2.3 (Gingerbread)">Android 2.3 (Gingerbread)</option>
					<option value="Android 2.2 (Froyo)">Android 2.2 (Froyo)</option>
					<option value="Android 2.0 - 2.1 (Eclair)">Android 2.0 - 2.1 (Eclair)</option>
					<option value="Android 1.6 (Donut)">Android 1.6 (Donut)</option>
					<option value="Android 1.5 (Cupcake)">Android 1.5 (Cupcake)</option>
				</select>
			</div>
		
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save POS</button>
				</div>
			</div>
			</form>
		</div>
	</div>
	<!-- END primary modal -->




	<!-- BEGIN primary modal -->
<div class="modal fade" id="uploadpos" tabindex="-1" aria-hidden="true" style="display: none;">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Upload Register POS</h5>
					<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
				</div>
				<div class="modal-body m-3">
					
			<form class="row g-3" action="{{route('import.terminals')}}" method="post" enctype="multipart/form-data">
			@csrf
				<div class="col-md-4">
					<label for="validationDefault01" class="form-label">Upload Excel file</label>
					<input type="file" class="form-control" id="validationDefault01" onkeyup="this.value = this.value.toUpperCase();" name="file" required>
				</div>

				<div class="col-md-10">
				<label for="validationDefault01" class="form-label">Excel Sample</label>
				<table class="table">
				<thead>
					<tr>
					<th scope="col">Device_name</th>
					<th scope="col">serial_no</th>
					<th scope="col">device_model</th>
					<th scope="col">imei</th>
					<th scope="col">mac_address</th>
					<th scope="col">device_make</th>
					<th scope="col">device_mfg</th>
					<th scope="col">od_version</th>
					
					</tr>
				</thead>
						<tbody>
							<tr>
							<th scope="row">Name 1</th>
							<td>S1234567</td>
							<td>SamsungGTM</td>
							<td>2542552365521452</td>
							<td>1253:24521452:526652</td>
							<td>SamsungGTM</td>
							<td>Samsung</td>
							<td>Android 4.4</td>
							</tr>
						</tbody>
				</table>
				</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Upload POS terminals</button>
				</div>
			</div>
			</form>
		</div>
	</div>
	<!-- END primary modal -->