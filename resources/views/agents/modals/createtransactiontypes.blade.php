<!-- BEGIN Create Transaction Type Modal -->
<div class="modal fade" id="createTransactionTypeModal" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTransactionTypeModalLabel">Create New Transaction Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-3">
                <form class="row g-3" method="POST" action="{{ route('transactionTypes.store') }}">
                    @csrf

                    <!-- Transaction Type Name -->
                    <div class="col-md-6">
                        <label for="tt_name" class="form-label">Transaction Type Name</label>
                        <input type="text" class="form-control" id="tt_name" name="tt_name" placeholder="Enter Transaction Type Name" required>
                    </div>

                    <!-- Transaction Type Notes -->
                    <div class="col-md-6">
                        <label for="tt_notes" class="form-label">Transaction Type Notes</label>
                        <input type="text" class="form-control" id="tt_notes" name="tt_notes" placeholder="Enter Transaction Type Notes">
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Create Transaction Type</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END Create Transaction Type Modal -->
