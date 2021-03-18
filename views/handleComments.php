<?php
include '../includes/database_connect.php';
session_start();

if (isset($_POST) && !empty($_POST)) {

    print_r($_POST);
    $content = $_POST['content'];
    $postId = $_POST['Id'];
    $userId = $_POST['userId'];

    $sql = "INSERT INTO comments(Comment_text, PostId, User_Id) VALUES(:content_IN,:postId_IN,:userId_IN)";
    $stm = $conn->prepare($sql);
    $stm->bindParam(':content_IN', $content);
    $stm->bindParam(':postId_IN', $postId);
    $stm->bindParam(':userId_IN', $userId);
    if ($stm->execute()) {
        header('location:comment.php?Id=' . $postId);
    } else {
        echo "comments not added";
    }
}
