<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="icon" type="image/png" sizes="16x16" href="Images/favicon-16x16.png">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <header class="blog-header py-3">
            <div class="row flex-nowrap justify-content-between align-items-center">
                <div class="col-4 pt-1">
                    <?php if (!isset($_SESSION['logged_IN'])) { ?>
                        <a class="link-secondary" href=/BloggCms/views/register.php">Sign-up</a>
                    <?php } ?>
                    <?php if (isset($_SESSION['logged_IN']) && $_SESSION['role'] == 'admin') { ?>
                        <a class="link-secondary" href="/BloggCms/views/createPost.php">Create Post</a>
                    <?php } ?>




                </div>
                <div class="col-4 text-center">
                    <a class="blog-header-logo text-dark" href="/BloggCms/index.php">MillHouse</a>
                </div>

                <div class="col-4 d-flex justify-content-end align-items-center">
                    <?php if (!isset($_SESSION['logged_IN'])) { ?>
                        <a class="btn btn-sm btn-outline-secondary" href="/BloggCms/views/login.php">Login</a>

                    <?php } ?>

                    <?php if (isset($_SESSION['logged_IN'])) { ?>
                        <a class="btn btn-sm btn-outline-secondary" href="/BloggCms/views/logout.php">Logout</a>
                    <?php } ?>
                </div>


            </div>
        </header>
        <hr>
        <?php if (isset($_SESSION['logged_IN'])) { ?>
            <div class="nav-scroller py-1 mb-2">
                <nav class="nav d-flex justify-content-between">
                    <a class="p-2 link-secondary" href="#">Clock</a>
                    <a class="p-2 link-secondary" href="#">Sunglasses</a>
                    <a class="p-2 link-secondary" href="#">Furnishing</a>

                </nav>
            </div>
        <?php } ?>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>


</body>

</html>