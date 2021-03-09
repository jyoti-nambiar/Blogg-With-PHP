<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Blogg||Register</title>
    <script src="script.js" defer></script>
</head>

<body>
    <header><?php include '../includes/header.php'; ?> </header>
    <form class="formValidator" method="POST" action="handleRegister.php">
        <div>


            <?php
            if (isset($_GET['error'])) { ?>
                <p class="error">
                    <?= $_GET['error']; ?>
                </p>

            <?php } ?>



        </div>
        <h2>Register With Us</h2>
        <div class="formControl">
            <label for="username">Username</label>
            <input type="text" class="text" name="username" placeholder="Enter Username">

        </div>
        <div class="formControl">
            <label for="email">Email</label>
            <input type="email" class="email" name="email" placeholder="Enter Email">

        </div>
        <div class="formControl">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Enter Password">

        </div>
        <div class="formControl">
            <label for="confirmPass">Confirm Password</label>
            <input type="password" name="confirmPass" placeholder="Enter Password again">

        </div>

        <label for="submitBtn"></label>
        <input type="submit" value="Submit" id="submitBtn">

    </form>

</body>

</html>