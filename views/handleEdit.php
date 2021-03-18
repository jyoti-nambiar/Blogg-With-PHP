<?php
include('../includes/database_connect.php');
session_start();
if (!empty($_FILES['imageToReplace']['name'])) {

    $upload_dir = "upload/";
    $target_file = $upload_dir . basename($_FILES['imageToReplace']['name']);
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (isset($_POST['submit'])) {

        $check = getimagesize($_FILES['imageToReplace']['tmp_name']);
        if ($check == false) {
            echo "The file is not an image!";
            die;
        }
    }
    if (file_exists($target_file)) {
        echo "The file already exists!";
        die;
    }
    if ($_FILES['imageToReplace']['size'] > 1000000) {
        echo "The file is too big!";
        die;
    }
    if ($fileType != "png" && $fileType != "gif" && $fileType != "jpg" && $fileType != "jpeg") {
        echo "You can only upload PNG, GIF, JPG or JPEG";
        die;
    }
    if (move_uploaded_file($_FILES['imageToReplace']['tmp_name'], $target_file)) {

        $username = $_SESSION['username'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $image = $target_file;
        $userId = $_SESSION['Id'];
        $postId = $_POST['Id'];
        $sql = "UPDATE posts SET Title=:title_IN,Image=:image_IN,CreatedBy=:username_IN, Content=:content_IN, UserId=:userid_IN WHERE Id=:postId_IN";
        $stm2 = $conn->prepare($sql);
        $stm2->bindParam(':title_IN', $title);
        $stm2->bindParam(':image_IN', $image);
        $stm2->bindParam(':username_IN', $username);
        $stm2->bindParam(':content_IN', $content);
        $stm2->bindParam(':userid_IN', $userId);
        $stm2->bindParam(':postId_IN', $postId);
        if ($stm2->execute()) {
            header('Location:../index.php?info="Post updated"');
        } else {
            echo "Something went wrong!";
        }
    } else {
        echo "Something went wrong!";
    }
} else {

    $username = $_SESSION['username'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $userId = $_SESSION['Id'];
    $postId = $_POST['Id'];
    $sql = "UPDATE posts SET Title=:title_IN,CreatedBy=:username_IN, Content=:content_IN, UserId=:userid_IN WHERE Id=:postId_IN";
    $stm2 = $conn->prepare($sql);
    $stm2->bindParam(':title_IN', $title);
    $stm2->bindParam(':username_IN', $username);
    $stm2->bindParam(':content_IN', $content);
    $stm2->bindParam(':userid_IN', $userId);
    $stm2->bindParam(':postId_IN', $postId);
    if ($stm2->execute()) {
        header('Location:../index.php?info="updated"');
    } else {
        echo "Something went wrong!";
    }
}
