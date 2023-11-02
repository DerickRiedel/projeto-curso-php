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
    <title>Dashboard</title>
</head>
<body>
    <div class="row">
        <div class="col-2">
            <div class="template" template="template/user/profile"> 

            </div>
        </div>  
        <div class="col-8">
            <div class="m-3">
            <div class="template" template="template/ticket/list?action=getJSON"> 

            </div>
            </div>
        </div>
        <div class="col-2">

        </div>
    </div>
</body>
</html>