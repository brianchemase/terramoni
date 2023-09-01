<!-- BEGIN Create Biller Modal -->
<div class="modal fade" id="createBillerModal" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createBillerModalLabel">Create New Biller</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-3">
                <form class="row g-3" method="POST" action="{{ route('billers.store') }}">
                    @csrf

                    <!-- Biller Category ID Dropdown -->
<div class="col-md-6">
    <label for="biller_cat_id" class="form-label">Biller Category</label>
    <select class="form-select" id="biller_cat_id" name="biller_cat_id" required>
        <option value="" selected disabled>Select Biller Category</option>
        @foreach($billerCategories as $billerCategory)
            <option value="{{ $billerCategory->biller_cat_id }}">{{ $billerCategory->biller_cat_name }}</option>
        @endforeach
    </select>
</div>


                    <!-- Biller Code -->
                    <div class="col-md-6">
                        <label for="biller_code" class="form-label">Biller Code</label>
                        <input type="text" class="form-control" id="biller_code" name="biller_code" placeholder="Enter Biller Code" required>
                    </div>

                    <!-- Biller Name -->
                    <div class="col-md-6">
                        <label for="biller_name" class="form-label">Biller Name</label>
                        <input type="text" class="form-control" id="biller_name" name="biller_name" placeholder="Enter Biller Name" required>
                    </div>

                    <!-- Biller URL -->
                    <div class="col-md-6">
                        <label for="biller_url" class="form-label">Biller URL</label>
                        <input type="text" class="form-control" id="biller_url" name="biller_url" placeholder="Enter Biller URL">
                    </div>

                    <!-- Biller Notes -->
                    <div class="col-md-12">
                        <label for="biller_note" class="form-label">Biller Notes</label>
                        <textarea class="form-control" id="biller_note" name="biller_note" placeholder="Enter Biller Notes" rows="3"></textarea>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Create Biller</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END Create Biller Modal -->
