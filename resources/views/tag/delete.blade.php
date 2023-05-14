<div class="modal fade" id="delete_tag" tabindex="-1" aria-labelledby="DeletetagLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="DeletetagLabel">Delete Tag</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="frm_destroy_tag">
                <div class="modal-body">
                    <p>Are you sure want to delete this data?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    <div class="text-right flex-grow">
                        <div class="text-right flex-grow">
                            <button type="submit" class="btn btn-primary btn_delete_tag">Delete <i class="fa-solid fa-spinner fa-spin btn_delete_spin_tag" style="display: none;"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
