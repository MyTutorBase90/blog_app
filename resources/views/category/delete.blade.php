<div class="modal fade" id="delete_category" tabindex="-1" aria-labelledby="DeleteCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="DeleteCategoryLabel">Delete Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="frm_destroy_category">
                <div class="modal-body">
                    <p>Are you sure want to delete this data?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    <div class="text-right flex-grow">
                        <div class="text-right flex-grow">
                            <button type="submit" class="btn btn-primary btn_delete_cat">Delete <i class="fa-solid fa-spinner fa-spin btn_delete_spin_cat" style="display: none;"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
