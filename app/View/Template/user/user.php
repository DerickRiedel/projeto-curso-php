<?php 
ob_end_clean();
?>
<script>
    $(document).ready(function(){
        $.ajax({
            method: 'post',
            url: 'user?action=getByIdJSON',
            data: {
                id_user: <?php echo $_GET['id_user'] ?>
            },
            success: function(response){
                data = JSON.parse(response)
                $('#user_name').html(data[0].name)
                $('#user_email').html(data[0].email)
            }
        })
    })
</script>
<div style="display: flex; flex-direction: row;" class="p-2">
    <img src="../../css/image/profile/user.png" width="75px" class="img-fluid rounded" alt="...">
    <br>
    <div class="p-2">
        <h5 class="card-title" id="user_name">
        </h5>
        <span id="user_email"></span>
    </div>
</div>
