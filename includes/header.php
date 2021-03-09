<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Document</title>
</head>

<body>



    <nav class="navbar navbar-expand-lg navbar-light" style=" background-color: #e3f2fd;">



        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/BloggCms/index.php">Home</a>
                    </li>
                    <!--Setting in conditions to view login and register only if not logged in-->
                    <?php
                    if (!isset($_SESSION['logged_IN'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/BloggCms/views/login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/BloggCms/views/register.php">Register</a>
                        </li>

                    <?php  } ?>
                    <!--Setting in conditions to view create Post only if logged in as admin-->
                    <?php
                    if (isset($_SESSION['role']) == "admin") { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/BloggCms/views/createPost.php">Create Post</a>
                        </li>
                    <?php  } ?>

                    <!--Setting in conditions to view logout only if logged in-->
                    <?php
                    if (isset($_SESSION['logged_IN'])) { ?>

                        <li class=" nav-item">
                            <a class="nav-link logout_link" href="/BloggCms/views/logout.php"><img src="/BloggCms/Images/person-circle.svg" alt="">

                            </a>
                        </li>
                    <?php  } ?>

            </div>
        </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>


</body>

</html>