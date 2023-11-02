<script>
    $(document).ready(function() {
        $(document).on('click','.category_list_item',function(){
            var item = $(this).children().map( function(){
                return $(this).text();
            }).get()
            if(item[0] != 'Id'){
                var id = item[0];
                $.ajax({
                    method: 'post',
                    url: 'category?action=getByIdJSON',
                    data: {id: id},
                    success: function(response){
                        data = JSON.parse(response);
                        $('#category_update_modal').modal('show');
                        $('#id_title').html("&nbsp"+data[0].id);
                        $('#id').val(data[0].id);
                        $('#name').val(data[0].name);
                        $('#description').val(data[0].description);
                        $('#has_item').prop('checked', data[0].has_item);
                    }
                })
            }
        })
    });
</script>
<div class="modal fade" id="category_update_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Category<h5 class="modal-title" id="id_title"></h5> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="category?action=update" method="post">
                    <input type="hidden" id="id" name="id">
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="col-form-label">Description</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <div class="mb-3 form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="has_item" name="has_item">
                        <label class="form-check-label" for="has_item">Has Items</label>
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