<script>
    $(document).ready(function() {
        $.ajax({
            data:{id_ticket: <?php echo $_GET['id'] ?>},
            method: 'POST',
            url:'item?action=getByTicketJSON',
            success: (response) => {
                json = JSON.parse(response);
                items = json.data;
                var items_list = items.map((item) => 
                {
                    return `
                    <div class="p-3 m-2 item" style="
                    -webkit-box-shadow: 0px 8px 48px -28px rgba(0,0,0,0.73);
                    -moz-box-shadow: 0px 8px 48px -28px rgba(0,0,0,0);
                    border-radius: 10px"> 
                        <h5>${item.name}</h5>
                        ${item.description}
                        <hr>
                        <div style="display: flex; justify-content: space-between">

                            <?php 
                            if(isset($_SESSION['admin'])){ 
                                echo 
                                '<div> 
                                    <span><b>Loaded: ${item.loaded_count}</b></span> / 
                                    <span><b>Requested: ${item.request_count}</b></span> / 
                                    <span><b>Available: ${item.count}</b></span> 
                                </div>
                                <div>
                                    <form action="ticket?action=loanTicketItem" method="post">
                                        <input type="hidden" name="id_ticket" value="${item.fk_ticket_id}"></input>
                                        <input type="hidden" name="id_ticket_item" value="${item.seq}"></input>
                                        <input type="hidden" name="id_item" value="${item.fk_item_id}"></input>
                                        <input style="width: 56px" type="number" name="loaded_count" value="${item.count}" min="0" max="${item.count}"></input>
                                        <button class="button2" type="submit">Loan</button>
                                    </form>
                                </div>
                                ';
                            }else{
                                echo '
                                <div>
                                    <span><b>Loaded: ${item.loaded_count}</b></span> / 
                                    <span><b>Requested: ${item.request_count}</b></span>
                                </div>
                                <div>
                                </div>';
                            }
                            ?>
                        </div>
                    </div>`
                }).join('')
                document.getElementById('item_list').innerHTML = items_list;
            }
        })

        function loanItem(id){

        }

    });
</script>
<div class="item_section p-4 m-2" style="border-radius: 10px;">
    <h4>
        Items
    </h4>
    <div id="item_list">
    </div>
</div>