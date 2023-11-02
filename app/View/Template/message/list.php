<?php 
ob_end_clean();
?>
<script>
    $(document).ready(function() {
        
        // alert(' e')
        $.ajax({
            method: 'post',
            url: 'message?action=getByIdJSON',
            data: {id: <?php echo $_GET['id'] ?>},
            success: (response) => {
                json = JSON.parse(response);
                messages = json.data;
                var messages_list = messages.map((item) => 
                {
                    var name
                    if(item.techname == null)
                        name = item.username
                    else{
                        name = item.techname
                    }
                    return `<div class="p-3 m-2 message" style="
                    -webkit-box-shadow: 0px 8px 48px -28px rgba(0,0,0,0.73);
                    -moz-box-shadow: 0px 8px 48px -28px rgba(0,0,0,0);
                    border-radius: 10px;
                    word-wrap: break-word"> 
                    <h5>${name}</h5>
                    ${item.description}</div>`
                }).join('')
                document.getElementById('message_list').innerHTML = messages_list;
            }
        })
    });
</script>
<div id="message_list">
</div>