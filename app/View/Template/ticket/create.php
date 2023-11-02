<?php 
ob_end_clean();
?>
<script>
    $(document).ready(function() {
        var categories_select
        $.ajax({
            method: 'post',
            url: 'category?action=getJSON',
            success: function(response){
                json = JSON.parse(response);
                categories = json.data;
                categories_select = categories
                var categories_list = categories.map((item) => {return `<option value="${item.id}">${item.name}</option>`})
                document.getElementById('id_category').innerHTML = (categories_list);
            }
        })
        // $('#id_category').off().change(function(){
        //     var e = document.getElementById("id_category");
        //     var value = e.value;
        //     var selectedCategory = e.options[e.selectedIndex].value;
        //     categories_select.forEach(element => {
        //         if(selectedCategory == element.id && element.has_item == true){
        //             alert('teste')
        //             $('#item_section').css("display","block");
        //         }else{
        //             $('#item_section').css("display","none");
        //         }
        //     });
        // })

    });
</script>
<div class="modal fade" id="ticket_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="ticket?action=insert" method="post">
                    <div class="mb-3">
                        <label for="subject" class="col-form-label">Subject</label>
                        <input type="text" required class="form-control" id="subject" name="subject">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="col-form-label">Description</label>
                        <textarea required class="form-control" id="description" name="description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="id_category" class="col-form-label">Category</label>
                        <select class="form-select id_category" aria-label="Default select example" id="id_category" name="id_category">
                        </select>
                    </div> 
                    <hr> 
                    <div id="item_section"> 
                        <?php 
                            include __DIR__ . '/../item/list_insert.php';
                        ?> 
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