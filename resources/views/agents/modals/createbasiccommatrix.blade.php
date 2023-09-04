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
                        <!-- <input type="text" class="form-control" id="agent_type" name="agent_type" placeholder="Enter Agent Type" required> -->
                        <select class="form-select" id="agent_type" name="agent_type" required>
                        <option value="" selected  disabled>Select Agent Type</option>
                            @foreach($agentTypes as $agenttype)
                            <option value="{{ $agenttype->id }}">{{ $agenttype->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="agent_tier_level" class="form-label">Agent Tier Level</label>
                        <!-- <input type="number" class="form-control" id="agent_tier_level" name="agent_tier_level" placeholder="Enter Agent Tier Level"> -->

                        <select class="form-select" id="agent_tier_level" name="agent_tier_level" required>
                        <option value="" selected  disabled>Select Agent Tier</option>
                            @foreach($agentTier as $agentier)
                            <option value="{{ $agentier->tier_id }}">{{ $agentier->tier_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="transaction_type" class="form-label">Transaction Type</label>
                        <!-- <input type="number" class="form-control" id="transaction_type" name="transaction_type" placeholder="Enter Transaction Type"> -->
                        <select class="form-select" id="transaction_type" name="transaction_type" required>
                        <option value="" selected  disabled>Select Transaction Type</option>
                            @foreach($transactionTypes as $transactiontype)
                            <option value="{{ $transactiontype->tt_id }}">{{ $transactiontype->tt_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="biller_id" class="form-label">Biller</label>
                        <!-- <input type="number" class="form-control" id="biller_id" name="biller_id" placeholder="Enter Biller" required> -->
                        <select class="form-select" id="biller_id" name="biller_id" required>
                        <option value="" selected disabled>Select Biller</option>
                        @foreach($billers as $biller)
                        <option value="{{ $biller->biller_id }}">{{ $biller->biller_name }}</option>
                        @endforeach
                    </select>
                    </div>
                   
                    <!-- ROW 3 -->
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="min_trans_amount" class="form-label">Min Commission Amount</label>
                            <input type="number" class="form-control" id="min_trans_amount" name="min_trans_amount" placeholder="Enter Min Transaction Amount" required>
                        </div>
                        <div class="col-md-4">
                            <label for="max_trans_amount" class="form-label">Max Commission Amount</label>
                            <input type="number" class="form-control" id="max_trans_amount" name="max_trans_amount" placeholder="Enter Max Transaction Amount">
                        </div>
                        <div class="col-md-4">
                            <label for="commission_rate" class="form-label">Commission Rate</label>
                            <input type="number" step="0.01" class="form-control" id="commission_rate" name="commission_rate" placeholder="Enter Commission Rate" required>
                        </div>
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
