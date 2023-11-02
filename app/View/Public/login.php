<?php
    $erro = $_GET['erro'];
    session_start();
    if(isset($_SESSION['user'])){
        header('Location: dashboard');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div class="row m-3">
        <div class="col-4"></div>
        <div class="col-4">
            <form class="p-5 rounded" action="user?action=login" method="POST">
                <?php 
                    if($erro == '2'){
                        echo 
                        '<div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control is-invalid" name="email" id="email" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control is-invalid" name="password" id="password">
                            <div id="invalidCheck3Feedback" class="invalid-feedback">
                                Incorret Email or Password
                            </div>
                        </div>';
                    }else{
                        echo 
                        '<div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>';
                    }
                ?>
                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-4"></div>
    </div>
</body>
</html>