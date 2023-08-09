  <!-- view Modal -->
  <div class="modal fade" id="viewAgentModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content ">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Showing Client no: {{$user->id}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <h4 class="text-center">Client number: {{$user->id}} </h4>
            <h5 >Name: {{$user->name}}</h5>
            
            <h5 >Phone: {{$user->mobile_no}}</h5>
            <h5 >Email: {{$user->email}}</h5> 
            <h5 >Username: {{$user->username}}</h5> 
            

                          @if($user->role == '0')
														<span class="badge bg-success">Agent</span>
													@elseif($user->role == '1')
														<span class="badge bg-danger">Aggregators</span>
													@elseif($user->role == '2')
														<span class="badge bg-warning">Admin</span>
													@endif
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         
        </div>
      </div>
    </div>
  </div>