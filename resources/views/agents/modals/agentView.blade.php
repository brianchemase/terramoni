  <!-- view Modal -->
  <div class="modal fade" id="viewAgentModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content ">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Showing Client no: {{$data->id}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <h4 class="text-center"><img src="{{ url('storage/ppts/'.$data->passport) }}"  style="height: 400px; width: 350px;"> </h4>
            <h4 class="text-center">Client number: {{$data->id}} </h4>
            <h5 >Name: {{$data->first_name}} {{$data->last_name}}</h5>
            <h5 >ID Number: {{$data->national_id_no}}</h5>
            <h5 >Phone: {{$data->phone}}</h5>
            <h5 >Gender: {{$data->gender}}</h5> 
            <h5 >Location: {{$data->location}}</h5>
            <h5 >Location: {{$data->country}}</h5>
            <h5 >Registration Date: {{ \Carbon\Carbon::parse($data->registration_date)->format('jS M Y') }}</h5>

            @if($data->status == 'approved')
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