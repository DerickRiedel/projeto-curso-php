<script>
    $(document).ready(function() {
        $(document).on('click','.item_list_item',function(){
            var item = $(this).children().map( function(){
                return $(this).text();
            }).get()
            if(item[0] != 'Id'){
                var id = item[0];
                $.ajax({
                    method: 'post',
                    url: 'item?action=getByIdJSON',
                    data: {id: id},
                    success: function(response){
                        data = JSON.parse(response);
                        // alert(response)
                        $('#item_update_modal').modal('show');
                        $('#id_item_title').html("&nbsp"+data[0].id);
                        $('#id_item').val(data[0].id);
                        $('#item_name').val(data[0].name);
                        $('#item_description').val(data[0].description);
                        $('#item_value').val(data[0].value);
                        $('#item_count').val(data[0].count);
                    }
                })
            }
        })
    });
</script>
<div class="modal fade" id="item_update_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Item <h5 class="modal-title" id="id_item_title"></h5></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="item?action=update" method="post">
                    <input type="hidden" name="id_item" id="id_item">
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