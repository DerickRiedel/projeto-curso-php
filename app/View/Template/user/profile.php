<?php 
ob_end_clean();
?>
<div class="card m-3" >
    <img src="../../css/image/profile/user.png" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">
            <?php 
                $user = $_SESSION['user'] ?? $_SESSION['admin'];
                echo $user[0]->name; 
            ?>
        </h5>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <?php 
                $user = $_SESSION['user'] ?? $_SESSION['admin'];
                echo $user[0]->email; 
            ?>
        </li>
    </ul>
    <div class="card-body"> 
        <button class="btn button2" id="user_update">Edit profile</button> 
    </div> 
</div> 
<div class="template" template="template/user/update">

</div>