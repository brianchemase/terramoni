<!-- BEGIN Create Promotion Modal -->
<div class="modal fade" id="createPromotionModal" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPromotionModalLabel">Create New Promotion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-3">
                <form class="row g-3" method="POST" action="{{ route('promotions.store') }}">
                    @csrf

                    <!-- ROW 1 -->
                    <div class="col-md-6">
                        <label for="promo_name" class="form-label">Promotion Name</label>
                        <input type="text" class="form-control" id="promo_name" name="promo_name" placeholder="Enter Promotion Name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="promo_notes" class="form-label">Promotion Notes</label>
                        <input type="text" class="form-control" id="promo_notes" name="promo_notes" placeholder="Enter Promotion Notes">
                    </div>

                    <!-- ROW 2 (Dates) -->
                    <div class="col-md-6">
                        <label for="promo_start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="promo_start_date" name="promo_start_date" required>
                    </div>
                    <div class="col-md-6">
                        <label for="promo_end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="promo_end_date" name="promo_end_date" required>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Create Promotion</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END Create Promotion Modal -->
