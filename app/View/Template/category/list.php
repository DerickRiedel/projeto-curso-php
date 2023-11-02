<?php 
ob_end_clean();
?>
<script>
    $(document).ready(function() {
        $('#category_table').DataTable({
            ajax: {
                method: 'POST',
                dataType: 'json',
                url:'category?action=<?php echo $_GET['action']; ?>'
            },
            responsive: 'true',
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'description' },
                { data: 'has_item' },
            ],
            createdRow: function(row){
                $(row).addClass("category_list_item");
            }
        });
    });
</script>
<table id="category_table" class="display">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Description</th>
            <th>Has Items</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>