<!-- BEGIN Create Agent Tier Modal -->
<div class="modal fade" id="defaultModalPrimary" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createAgentTierModalLabel">Create New Agent Tier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-3">
                <form class="row g-3" method="POST" action="{{ route('agentTiers.store') }}">
                    @csrf

                    <!-- ROW 1 -->
                    <div class="col-md-6">
                        <label for="tier_name" class="form-label">Tier Name</label>
                        <input type="text" class="form-control" id="tier_name" name="tier_name" placeholder="Enter Agent Tier Name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="tier_notes" class="form-label">Tier Notes</label>
                        <input type="text" class="form-control" id="tier_notes" name="tier_notes" placeholder="Enter Agent Tier Notes">
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Create Agent Tier</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END Create Agent Tier Modal -->
