<?php
    session_start();
    if(!isset($_SESSION['user']) && !isset($_SESSION['admin'])){
        header('Location: login?erro=1');
    }
    if(!is_numeric($_GET['id'])){
        header('Location: dashboard');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
</head>
<body>
    <div class="row">
        <div class="col-2 ">
            <div class="template" template="template/user/profile"> 

            </div>
        </div>  
        <div class="col-6 "> 
            <?php 
                $action = 'update'; 
                $template->ticket($action); 
            ?>
        </div>
        <div class="col-4 pr-5">
            <?php 
                
                $template->item_ticket_list(); 
            ?>
        </div>
    </div>
</body>
</html>