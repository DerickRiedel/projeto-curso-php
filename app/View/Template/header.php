<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Tickets</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php
                    if(isset($_SESSION['user'])){
                        echo '
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <form action="user?action=logout" method="post">
                                <button class="nav-link" style="background: none; border: none;" type="submit">Logout</button>
                            </form>
                        </li>
                        ';
                    }else if(isset($_SESSION['admin'])){
                        echo '
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="settings">Settings</a>
                        </li>
                        <li class="nav-item">
                            <form action="admin?action=logout" method="post">
                                <button class="nav-link" style="background: none; border: none;" type="submit">Logout</button>
                            </form>
                        </li>
                        ';
                    }else{
                        echo '
                        <li class="nav-item">
                            <a class="nav-link" href="about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="signup">Signup</a>
                        </li>
                        ';
                    }
                ?>
            </ul>
        </div>
    </div>
</nav>