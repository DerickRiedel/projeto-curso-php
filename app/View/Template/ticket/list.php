<?php 
ob_end_clean();
?>
<script>
    $(document).ready(function() {
        status = {'O':'OPEN', 'P':'PROCESS', 'C':'CLOSED'}
        $('#ticket_table').DataTable({
            ajax: {
                method: 'POST',
                dataType: 'json',
                url:'ticket?action=<?php echo $_GET['action']; ?>'
            },
            responsive: 'true',
            columns: [
                { data: 'id' },
                { data: 'subject' },
                { data: 'create_date' },
                { data: 'modified_date' },
                { data: 'status' }
            ]
        });
        $(document).on('click','.odd, .even',function(){
            var item = $(this).children().map( function(){
                return $(this).text();
            }).get()
            if(item[0] != 'Id'){
                var id = item[0];
                window.location.href = 'ticket-update?id='+id
            }
        })
    });
</script>
<table id="ticket_table" class="display">
    <thead>
        <tr>
            <th>Id</th>
            <th>Subject</th>
            <th>Create date</th>
            <th>Modified date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>