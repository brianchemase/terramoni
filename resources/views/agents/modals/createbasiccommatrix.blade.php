<!-- BEGIN Create Basic Commission Matrix Modal -->
<div class="modal fade" id="basicCommissionModal" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createBasicCommissionModalLabel">Create New Basic Commission Matrix</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-3">
                <form class="row g-3" method="POST" action="{{ route('basiccommissionmatrix.store') }}" enctype="multipart/form-data">
                    @csrf
                    {{-- <div class="col-md-6">
                        <label for="agent_role" class="form-label">Agent Role</label>
                        <input type="text" class="form-control" id="agent_role" name="agent_role" placeholder="Enter Agent Role" required>
                    </div> --}}
                    <div class="col-md-6">
                        <label for="agent_type" class="form-label">Agent Type</label>
                        <input type="text" class="form-control" id="agent_type" name="agent_type" placeholder="Enter Agent Type" required>
                    </div>
                    <div class="col-md-6">
                        <label for="agent_tier_level" class="form-label">Agent Tier Level</label>
                        <input type="number" class="form-control" id="agent_tier_level" name="agent_tier_level" placeholder="Enter Agent Tier Level">
                    </div>
                    <div class="col-md-6">
                        <label for="transaction_type" class="form-label">Transaction Type</label>
                        <input type="number" class="form-control" id="transaction_type" name="transaction_type" placeholder="Enter Transaction Type">
                    </div>
                    <div class="col-md-6">
                        <label for="min_trans_amount" class="form-label">Min Transaction Amount</label>
                        <input type="number" class="form-control" id="min_trans_amount" name="min_trans_amount" placeholder="Enter Min Transaction Amount" required>
                    </div>
                    <div class="col-md-6">
                        <label for="max_trans_amount" class="form-label">Max Transaction Amount</label>
                        <input type="number" class="form-control" id="max_trans_amount" name="max_trans_amount" placeholder="Enter Max Transaction Amount">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Basic Commission Matrix</button>
                    </div>
                   
                </form>
            </div>
            
        </div>
    </div>
</div>
<!-- END Create Basic Commission Matrix Modal -->
