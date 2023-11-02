<?php 
ob_end_clean();
?>
<script>
    $(document).ready(function() {
        $('#item_table').DataTable({
            ajax: {
                method: 'POST',
                dataType: 'json',
                url:'item?action=<?php echo $_GET['action']; ?>'
            },
            responsive: 'true',
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'description' },
                { data: 'value' },
                { data: 'create_date' },
                { data: 'count' },
            ],
            createdRow: function(row){
                $(row).addClass("item_list_item");
            }
        });
    });
</script>
<table id="item_table" class="display">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Description</th>
            <th>Value</th>
            <th>Create date</th>
            <th>Count</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>