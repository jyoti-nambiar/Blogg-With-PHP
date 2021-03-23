<?php include '../includes/header.php'; ?>
<?php if (!isset($_SESSION)) {
    header('Location:../index.php');
}  ?>

<?php if (isset($_SESSION) && $_SESSION['role'] == 'user') {
    header('Location:../index.php');
}  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogg|| Edit POST</title>
</head>

<body>


    <?php

    include('../includes/database_connect.php');
    include('../Classes/post.php');
    $Id = $_GET['id'];
    echo $Id;
    $sql = "SELECT * FROM posts WHERE Id=$Id";
    $stm = $conn->prepare($sql);
    if ($stm->execute()) {
        $row = $stm->fetch();
        $postData = new post($row['Id'], $row['CreatedBy'], $row['Title'], $row['Image'], $row['Date_Time'], $row['Content']);
    }



    ?>
    <form class="formValidator" method="post" action="handleEdit.php" enctype="multipart/form-data">
        <h2>Edit Post</h2>


        <input type="hidden" name="Id" value="<?= $Id ?>">

        </div>
        <div class="formControl">
            <label for="username">Title</label>
            <input type="text" class="text" name="title" placeholder="Enter Title" value="<?= $postData->getTitle(); ?>">

        </div>
        <div class="formControl">
            <textarea name="content" id="" cols="45" rows="10" placeholder="Enter Content">
            <?= $postData->getContent(); ?>
            </textarea>

        </div>

        <div class="formControl">
            <input type="file" name="imageToReplace" id="">
        </div>


        <label for="submitBtn"></label>
        <input type="submit" value="Update" id="submitBtn">


    </form>


</body>


</html>