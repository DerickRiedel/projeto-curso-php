<div class="modal fade" id="item_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="item?action=insert" method="post">
                    <div class="mb-3">
                        <label for="item_name" class="col-form-label">Name</label>
                        <input type="text" class="form-control" id="item_name" name="item_name">
                    </div>
                    <div class="mb-3">
                        <label for="item_description" class="col-form-label">Description</label>
                        <textarea class="form-control" id="item_description" name="item_description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="item_value" class="col-form-label">Value</label>
                        <input type="number" class="form-control" id="item_value" name="item_value"></input>
                    </div>
                    <div class="mb-3">
                        <label for="item_count" class="col-form-label">Count</label>
                        <input type="number" class="form-control" id="item_count" name="item_count"></input>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>