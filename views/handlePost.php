<?php
include '../includes/database_connect.php';
session_start();

if (!empty($_FILES['imageToUpload']['name'])) {

    $upload_dir = "upload/";
    $target_file = $upload_dir . basename($_FILES['imageToUpload']['name']);
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (isset($_POST['submit'])) {

        $check = getimagesize($_FILES['imageToUpload']['tmp_name']);
        if ($check == false) {
            echo "The file is not an image!";
            die;
        }
    }
    if (file_exists($target_file)) {
        echo "The file already exists!";
        die;
    }
    if ($_FILES['imageToUpload']['size'] > 1000000) {
        echo "The file is too big!";
        die;
    }
    if ($fileType != "png" && $fileType != "gif" && $fileType != "jpg" && $fileType != "jpeg") {
        echo "You can only upload PNG, GIF, JPG or JPEG";
        die;
    }

    if (move_uploaded_file($_FILES['imageToUpload']['tmp_name'], $target_file)) {

        $username = $_SESSION['username'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $date_time = date("Y-m-d");
        $image = $target_file;
        $id = $_POST['Id'];
        $selected_val = $_POST['Category'];
        $sql = "INSERT INTO posts (Title,Image,Category,Date_time, CreatedBy,Content, UserId) VALUES(:title_IN,:image_IN,:category_IN,'$date_time',:username_IN, :content_IN, :userid_IN)";
        $stm2 = $conn->prepare($sql);
        $stm2->bindParam(':title_IN', $title);
        $stm2->bindParam(':image_IN', $image);
        $stm2->bindParam(':category_IN', $selected_val);
        $stm2->bindParam(':username_IN', $username);
        $stm2->bindParam(':content_IN', $content);
        $stm2->bindParam(':userid_IN', $id);

        if ($stm2->execute()) {
            header('Location:../index.php');
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
    $date_time = date("Y-m-d");
    $id = $_POST['Id'];
    $selected_val = $_POST['Category'];
    $query = "INSERT INTO posts (Title,Category,Date_time, CreatedBy,Content, UserId) VALUES(:title_IN,:category_IN,'$date_time',:username_IN, :content_IN, :userid_IN)";
    $stm2 = $conn->prepare($query);
    $stm2->bindParam(':title_IN', $title);
    $stm2->bindParam(':category_IN', $selected_val);
    $stm2->bindParam(':username_IN', $username);
    $stm2->bindParam(':content_IN', $content);
    $stm2->bindParam(':userid_IN', $id);
    if ($stm2->execute()) {

        header('location:../index.php');
    } else {
        echo "error creating new post";
    }
}
