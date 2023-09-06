  <!-- view Modal -->
  <div class="modal fade" id="viewPOS{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content ">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Showing POS ID: {{$data->id}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            
            <h4 class="text-center">POS  ID: {{$data->id}} </h4>
            <h5 >Name: {{$data->device_name}} </h5>
            <h5 >POS Serial: {{$data->serial_no}}</h5>
            <h5 >POS Model: {{$data->device_model}}</h5>
            <h5 >POS Owner Type: {{$data->owner_type}}</h5>
         
            <h5 >Registration Date: {{ \Carbon\Carbon::parse($data->assignment_date)->format('jS M Y') }}</h5>

            @if($data->status == 'Assigned')
            <h5 >Status:   <span class="badge bg-success">Active</span></h5> 
            @elseif($data->status == 'suspended')
            <h5 >Status:   <span class="badge bg-danger">Suspended</span></h5> 
            @elseif($data->status == 'pending')
            <h5 >Status:  <span class="badge bg-warning">Pending</span></h5> 
            @endif
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         
        </div>
      </div>
    </div>
  </div>


  <!-- Modal -->
<div class="modal fade" id="suspendpos{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">POS  ID: {{$data->id}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <h4 class="text-center">POS  ID: {{$data->id}} </h4>
      <form method="POST" action="{{ route('updatePosTerminal') }}">
        @csrf
        <div class="form-group">
            <label for="POSSerial">POS Serial</label>
            <input type="text" class="form-control" name="serial_no" value="{{ $data->serial_no }}">
        </div>
        <div class="form-group">
            <label for="actionselection">Select Action</label>
            <select class="form-control" name="action" id="exampleFormControlSelect1">
                <option value="Suspend">Suspend/Suspect Fraud</option>
                <option value="Repossess">Repossess</option>
                <option value="faulty">Faulty/Damaged</option>
                <option value="Deactivate">Inactivity</option>
                <!-- <option value="4">4</option>
                <option value="5">5</option> -->
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Comment</label>
            <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update POS Terminal</button>
      </div>
      </form>
    </div>
  </div>
</div>