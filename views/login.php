<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Blogg||Login</title>
    <link rel="stylesheet" href="../CSS/style.css">

</head>

<body>



    <header><?php include '../includes/header.php'; ?> </header>





    <form class="formValidator" method="POST" action="handleLogin.php">
        <div>


            <?php
            if (isset($_GET['success'])) { ?>
                <p class="success">
                    <?= $_GET['success']; ?>
                </p>

            <?php } ?>



        </div>
        <div>


            <?php
            if (isset($_GET['error'])) { ?>
                <p class="error">
                    <?= $_GET['error']; ?>
                </p>

            <?php } ?>



        </div>


        <h2>Login</h2>


        <div class="formControl">
            <label for="username">Username/Password</label>
            <input type="text" class="text" name="username_email" placeholder="Enter Username">

        </div>

        <div class="formControl">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Enter Password">

        </div>

        <label for="submitBtn"></label>
        <input type="submit" value="Submit" id="submitBtn">

    </form>

</body>

</html>