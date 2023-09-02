
<!-- BEGIN edit user modal -->
<div class="modal fade" id="editRoleModal{{ $role->id }}" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Role</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body m-3">
                <form class="row g-3" action="{{ route('admin.update.role') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <input type="hidden" name="role_id" value="{{ $role->id }}">
                    <div class="col-md-6">
                        <label for="editName" class="form-label">Role</label>
                        <input type="text" class="form-control" id="editRole" name="name" placeholder="Enter Role" value="{{ $role->name }}" required>
                    </div>                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END edit user modal -->