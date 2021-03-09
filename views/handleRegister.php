<?php
include '../includes/database_connect.php';
if (isset($_POST)) {
    if (empty($_POST['username'])) {

        header('location:register.php?error=Please fill username');
        die();
    }
    if (empty($_POST['email'])) {

        header('location:register.php?error=Please fill email');
        die();
    }
    if (empty($_POST['password'])) {
        header('location:register.php?error=Please fill in the password');
        die();
    }
    if (empty($_POST['confirmPass'])) {
        header('location:register.php?error=Please fill in the confirm password');
        die();
    }
    if ($_POST['password'] !== $_POST['confirmPass']) {
        header('location:register.php?error=The passwords doesnt match');
        die();
    }

    $username = $_POST['username'];
    $email = $_POST['email'];


    $query = ("SELECT count(*) FROM users WHERE (Username=:username_IN OR Email=:email_IN)");
    $query = $conn->prepare($query);
    $query->bindParam(':username_IN', $username);
    $query->bindParam(':email_IN', $email);
    $query->execute();
    $count = $query->fetch();
    if ($count[0] > 0) {
        header('location:register.php?error=User already exist');
    } else {

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $salt = '@hellothis$$$$isfor&&&&&&&passwordprotection';
        $password = md5($password . $salt);
        $sql = ("INSERT INTO users (Username, Email, Password,Role) VALUES(:username_IN, :email_IN, :password_IN, 'user')");
        $stm = $conn->prepare($sql);
        $stm->bindParam(':username_IN', $username);
        $stm->bindParam(':email_IN', $email);
        $stm->bindParam(':password_IN', $password);
        if ($stm->execute()) {
            header('location:login.php?success=Welcome' . " " . $username);
        } else {
            echo "registration error";
        }
    }
}
