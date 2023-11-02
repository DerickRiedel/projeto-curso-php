<script>
    $(document).ready(function() {
        $.ajax({
            method: 'post',
            url: 'category?action=getJSON',
            success: function(response){
                json = JSON.parse(response);
                categories = json.data;
                var categories_list = categories.map((item) => {return `<option value="${item.id}">${item.name}</option>`})
                document.getElementById('id_category').innerHTML = (categories_list);
            }
        })
        $.ajax({
            method: 'post',
            url: 'ticket?action=getByIdJSON',
            data: {id: <?php echo $_GET['id'] ?>},
            success: function(response){
                data = JSON.parse(response);
                ticket_data = data
                $('#ticket_update_modal').modal('show');
                $('#id_title').html("&nbsp"+data[0].id);
                $('#id').val(data[0].id);
                $('#status').val(data[0].status);
                $('#subject').html(data[0].subject);
                $('#description').html(data[0].description);
                $('#id_category').val(data[0].fk_category_id);

                $('#ticket_user').load('template/user/user?id_user='+data[0].fk_userlogin_id);
                $('#ticket_message').load('template/message/list?id=<?php echo $_GET['id'] ?>')
            }
        })

        $('#reply').off().click(function(){
            if($('#message_description').val() != '' && $('#message_description').val() != ' '){
            $.ajax({
                method: 'post',
                data: {
                    id_ticket: <?php echo $_GET['id'] ?>,
                    description: $('#message_description').val()
                },
                url: 'message?action=insert'
            })
            location.reload()
            }
        })
    });
</script>
    <div class="p-4 m-2 ticket" style="
        -webkit-box-shadow: 0px 8px 48px -10px rgba(0,0,0,0.5);
        -moz-box-shadow: 0px 8px 48px -10px rgba(0,0,0,0.5);
        box-shadow: 0px 8px 48px -10px rgba(0,0,0,0.5);
        border-radius: 10px;
    ">
        <div class="row" style="justify-content: space-between;">
            <h3 class="col-6">Ticket<span id="id_title"></span></h3>
            <button type="button" onclick="history.back()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <?php 
                if(isset($_SESSION['user'])){
                    echo '<form>';
                }else if(isset($_SESSION['admin'])){
                    echo '<form action="ticket?action=update" method="post">';
                }
            ?>
            <input type="hidden" id="id" name="id">
            <div class="row">
                <div class="col-7">

                    <div class="template mb-3" id="ticket_user">
                    </div>

                    <div class="mb-3">
                        <label for="subject" class="col-form-label"> <h6>Subject</h6></label>
                        <p id="subject" name="subject">
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="col-form-label"> <h6>Description</h6></label>
                        <p id="description" style="word-wrap: break-word;" name="description"></p>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-8">
                            <div class="mb-3">
                                <label for="id_category" class="col-form-label">Category</label>
                                <select class="form-select id_category" aria-label="Default select example" id="id_category" name="id_category">
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="status" class="col-form-label">Status</label>
                                <select class="form-select" aria-label="Default select example" id="status" name="status">
                                    <option value="O">Open</option>
                                    <option value="P">In Process</option>
                                    <option value="C">Closed</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <br>
            <?php 
                if(isset($_SESSION['user'])){
                    
                }else if(isset($_SESSION['admin'])){
                    echo '
                    <div style="display: flex; justify-content: end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>';
                }
            ?>
        </form>
        <br>
        <hr>
        <br>
        <div class="mb-3">
            <textarea class="form-control" id="message_description" name="message_description"></textarea>
            <br>
            <div style="display: flex; justify-content: end">
            <button id="reply" class="btn btn-primary">Reply</button>
            </div>
        </div>
        <br>
        <div id="ticket_message" class="template">

        </div>
    </div>