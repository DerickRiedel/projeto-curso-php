<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location: login?erro=1');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <div class="row">
        <div class="col-2">
            <div class="template" template="template/user/profile"> 

            </div>
        </div>  
        <div class="col-8">
            <div class="m-3 mt-5">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ticket_modal" data-bs-whatever="@mdo" type="submit">New ticket</button>
            </div>  
            <div class="m-3">
                <div class="template" template="template/ticket/list?action=getByUserJSON"> 

                </div>
            </div>
        </div>
        <div class="col-2">
        </div>
    </div>
    
    <div class="template" template="template/ticket/create"> 

    </div>
</body>
</html>