<!-- BEGIN Create Agent Type Modal -->
<div class="modal fade" id="createAgentTypeModal" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createAgentTypeModalLabel">Create New Agent Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-3">
                <form class="row g-3" method="POST" action="{{ route('agentTypes.store') }}">
                    @csrf

                    <!-- Agent Type Name -->
                    <div class="col-md-6">
                        <label for="name" class="form-label">Agent Type Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Agent Type Name" required>
                    </div>

                    

                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Create Agent Type</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END Create Agent Type Modal -->
