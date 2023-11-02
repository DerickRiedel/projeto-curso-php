<script>
    $(document).ready(function(){

        item_select = `
        <select class="form-select id_item" aria-label="Default select example" id="id_item" name="id_item">
        </select>
        `

        var items
        function item_list(data){
            return data.map((item) => 
            {return `<option value="${item.id}">${item.name}</option>`})
        }


        $.ajax({
            method: 'post',
            url: 'item?action=getJSON',
            success: function(response){
                json = JSON.parse(response);
                items = json.data
            }
        })


        $('#add_item').off().click(() =>{
            $('#item_list').append(`
            <div class="row item_row">
                <div class="col-7">
                    <label for="id_item" class="col-form-label">Item</label>
                    <select class="form-select id_item" name="id_item[]">
                    `+item_list(items)+`
                    </select>
                </div>
                <div class="col-3">
                    <label for="item_count" class="col-form-label">Count</label>
                    <input type="number" class="form-control" required name="item_count[]"></input>
                </div>
                <div class="col-2">
                    <br>
                    <button onclick="return this.parentNode.parentNode.remove();" type="button" class="m-3">
                        <i class="fa-solid fa-minus"></i>
                    </button>
                </div>
            </div>
            `)
        })
    })
</script>
<h4>Equipment</h4>
<ul id="item_list">

</ul>
<button id="add_item" type="button" class="m-3 mb-4">
    <i class="fa-solid fa-plus"></i>
</button>
<br>

