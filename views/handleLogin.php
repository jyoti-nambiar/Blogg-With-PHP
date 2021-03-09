<?php
include '../includes/database_connect.php';
if (isset($_POST['username_email']) && isset($_POST['password'])) {
    if (empty($_POST['username_email'])) {
        header('location:login.php?error=Please enter the username/email');
        die();
    }

    if (empty($_POST['password'])) {
        header('location:login.php?error=Please enter the password');
        die();
    }
    $username = $_POST['username_email'];
    $email = $_POST['username_email'];
    $password = $_POST['password'];
    $salt = '@hellothis$$$$isfor&&&&&&&passwordprotection';
    $password = md5($password . $salt);
    $sql = ("SELECT count(Id),Role FROM users WHERE (Username=:username_IN OR Email=:email_IN) AND Password=:password_IN");
    $stm = $conn->prepare($sql);
    $stm->bindParam(':username_IN', $username);
    $stm->bindParam(':email_IN', $email);
    $stm->bindParam(':password_IN', $password);
    $stm->execute();
    $count = $stm->fetch();
    //print_r($count);
    //echo $count['Role'];

    if ($count[0] > 0) {
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['logged_IN'] = 'yes';
        $_SESSION['role'] = $count['Role'];
        header('location:../index.php');
    }
} else {
    header('location:login.php?error=user is not registered');
}
