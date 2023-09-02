<form method="GET" action="{{ route('commissionmatrix.store') }}">
    @csrf

    <!-- ROW 1 -->
    <div class="row g-3">
        <div class="col-md-4">
            <label for="agent_role" class="form-label">Agent Role</label>
            <select class="form-select" id="agent_role" name="agent_role" required>
                <option value="Aggregator">Aggregator</option>
                <option value="Agent">Agent</option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="agent_type" class="form-label">Agent Type</label>
            <select class="form-select" id="agent_type" name="agent_type" required>
                <option value="Individual">Individual</option>
                
                
            </select>
        </div>
        <div class="col-md-4">
            <label for="agent_tier" class="form-label">Agent Tier</label>
            <select class="form-select" id="agent_tier" name="agent_tier">
                <option value="General">General (DEFAULT)</option>
                <option value="Tier 1">Tier 1</option>
                <option value="Tier 2">Tier 2</option>
                <option value="Tier 3">Tier 3</option>
            </select>
        </div>
    </div>

    <!-- ROW 2 -->
    <div class="row g-3">
        <div class="col-md-4">
            <label for="transaction_type" class="form-label">Transaction Type</label>
            <select class="form-select" id="transaction_type" name="transaction_type" required>
                
            </select>
        </div>
        <div class="col-md-4">
            <label for="biller" class="form-label">Biller</label>
            <select class="form-select" id="biller" name="biller" required>
                
            </select>
        </div>
        <div class="col-md-4">
            <label for="biller_offering" class="form-label">Biller Offering</label>
            <select class="form-select" id="biller_offering" name="biller_offering" required>

            </select>
        </div>
    </div>

    <!-- ROW 3 -->
    <div class="row g-3">
        <div class="col-md-4">
            <label for="min_commission_amount" class="form-label">Min Commission Amount</label>
            <input type="text" class="form-control" id="min_commission_amount" name="min_commission_amount">
        </div>
        <div class="col-md-4">
            <label for="max_commission_amount" class="form-label">Max Commission Amount</label>
            <input type="text" class="form-control" id="max_commission_amount" name="max_commission_amount">
        </div>
        <div class="col-md-4">
            <label for="commission_rate" class="form-label">Commission Rate (%)</label>
            <input type="number" step="0.01" class="form-control" id="commission_rate" name="commission_rate" required>
        </div>
    </div>

    
    <div class="row mt-3">
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Save Commission Matrix</button>
        </div>
    </div>
</form>
