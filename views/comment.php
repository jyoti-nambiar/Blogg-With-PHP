<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--Bootstrap cdn-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/style.css">
</head>

<body>
    <?php
    include('../includes/database_connect.php');
    include('../includes/header.php');
    include('../includes/function.php');

    if (isset($_POST['delete'])) {
        print_r($_POST);
        $postId = $_POST['PostId'];
        $commentId = $_POST['CommentId'];
        $query = "DELETE FROM comments WHERE Id=$commentId";
        $statement = $conn->prepare($query);
        if ($statement->execute()) {
            header('Location:comment.php?Id=' . $postId);
        } else {
            echo "Comment is not deleted";
        }
    }


    $Id = $_GET['Id'];
    $sql = "SELECT * FROM posts WHERE Id=$Id";
    $stm = $conn->prepare($sql);
    $stm->execute();
    $row = $stm->fetch();
    if ($row) {
        // print_r($row);
        include('../Classes/post.php');
        $postData = new post($row['Id'], $row['CreatedBy'], $row['Title'], $row['Image'], $row['Date_Time'], $row['Content']);
    ?>
        <main class="container">
            <article class="blog-post">
                <h2 class="blog-post-title"><?= noHtml($postData->getTitle()); ?></h2>
                <p class="blog-post-meta"><?= $postData->getDateTime(); ?> by <?= $postData->getUsername(); ?></p>
                <?php if (!empty($postData->getImage())) { ?>
                    <p><img src="/BloggCms/views/<?= $postData->getImage(); ?>" alt="postimg" style="width:200px; height:200px;"></p>
                <?php } ?>

                <p><?= noHtml($postData->getContent()); ?></p>

            </article>
            <?php
            $query = "SELECT c.Id,c.Comment_text,c.Post_Id, u.Username FROM comments AS c JOIN users AS u ON u.Id = c.User_Id WHERE c.Post_Id=$Id";
            $statement = $conn->prepare($query);
            $statement->execute();
            $count = $statement->rowCount();

            echo "<h3>Comments</h3>";
            while ($row = $statement->fetch()) {
                //print_r($row);
                $comment = noHtml($row['Comment_text']);
                $username = noHtml($row['Username']);
                //$count = $row['NumComments'];
            ?>
                <p class='comments'> <?= $comment ?><span class='username'><?= $username ?></span>
                    <?php if (!empty($row) && isset($_SESSION) && $_SESSION['role'] == 'admin') { ?>
                <form action="" method='post'>
                    <input type="hidden" name="PostId" value=<?= $row['Post_Id']; ?>>
                    <input type="hidden" name="CommentId" value="<?= $row['Id'] ?>">
                    <input type="submit" name="delete" class="delete-btn" value="Delete">


                </form>
            <?php } ?>
            </p>

        <?php

            }

        ?>

        <form id="form1" action="handleComments.php" method="POST">
            <input type="hidden" name="userId" value=<?= $_SESSION['Id']; ?>>
            <input type="hidden" name="username" value=<?= $postData->getUsername(); ?>>
            <input type="hidden" name="Id" value=<?= $postData->getId(); ?>>
            <textarea name="content" id="" cols="30" rows="3"></textarea>
            <input class="btn-comment" type="submit" value="Comment">
        </form>
        </main>

    <?php
    } else {
        echo "no data from database";
        die();
    }
    ?>

</body>

</html>