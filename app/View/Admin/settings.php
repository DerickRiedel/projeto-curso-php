<?php
    session_start();
    if(!isset($_SESSION['admin'])){
        header('Location: login?erro=1');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
</head>
<body>
    <div class="row">
        <div class="col-2">
            <div class="template" template="template/user/profile" > 

            </div>
        </div>  
        <div class="col-8">
            <hr>
            <div class="m-3">
                <h4>Category settings</h4>
            </div>
            <div class="m-3">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#category_modal" data-bs-whatever="@mdo" type="submit">New Category</button>
            </div>  
            <div class="m-3">
                <div class="template" template="template/category/list?action=getJSON">

                </div>
            </div>
            <br>
            <hr>
            <div class="m-3">
                <h4>Item settings</h4>
            </div>
            <div class="m-3">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#item_modal" data-bs-whatever="@mdo" type="submit">New Item</button>
            </div> 
            <div class="m-3">
                <div class="template" template="template/item/list?action=getJSON">

                </div>
            </div>
        </div>
        <div class="col-2">

        </div>
    </div>
    <?php 
        $action = 'update';
        $template->category($action);
        $action = 'create';
        $template->category($action);
        $action = 'update';
        $template->item($action);
        $action = 'create';
        $template->item($action);
    ?>
</body>
</html>