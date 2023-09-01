<!-- BEGIN Create Customer Segment Modal -->
<div class="modal fade" id="createCustomerSegmentModal" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCustomerSegmentModalLabel">Create New Customer Segment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-3">
                <form class="row g-3" method="POST" action="{{ route('customerSegments.store') }}">
                    @csrf

                    <!-- Customer Segment Name -->
                    <div class="col-md-6">
                        <label for="cs_name" class="form-label">Customer Segment Name</label>
                        <input type="text" class="form-control" id="cs_name" name="cs_name" placeholder="Enter Customer Segment Name" required>
                    </div>

                    <!-- Customer Segment Notes -->
                    <div class="col-md-12">
                        <label for="cs_notes" class="form-label">Customer Segment Notes</label>
                        <textarea class="form-control" id="cs_notes" name="cs_notes" placeholder="Enter Customer Segment Notes" rows="3"></textarea>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Create Customer Segment</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END Create Customer Segment Modal -->
