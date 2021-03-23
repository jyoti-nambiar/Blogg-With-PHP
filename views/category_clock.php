<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category||Clock</title>
</head>

<body>
    <?php include('../includes/header.php');
    include('../includes/database_connect.php');
    include('../Classes/post.php'); ?>

    <?php

    if (isset($_GET['info']) && $_GET['info'] == 'deleted') {
        $updateMsg = "The post has been deleted";
        echo "<p class='error'>$updateMsg </p>";
    }
    ?>


    <?php if (isset($_POST['Id'])) {
        print_r($_POST);
        $postId = $_POST['Id'];
        $query = "DELETE FROM posts WHERE Id=$postId";
        $statement = $conn->prepare($query);
        if ($statement->execute()) {
            header('Location:category_clock.php?info=deleted');
        } else {
            echo "Post is not deleted";
        }
    }
    ?>
    <main class="container">
        <div class="row">
            <div class="col-md-8">
                <h3 class="pb-4 mb-4 fst-italic border-bottom">
                    From the Firehose
                </h3>


                <?php


                $sql = 'CALL GetCategoryClock()';
                $stm = $conn->prepare($sql);
                $stm->execute();
                while ($row = $stm->fetch()) {
                    $postData = new post($row['Id'], $row['CreatedBy'], $row['Title'], $row['Image'], $row['Date_Time'], $row['Content']);

                ?>

                    <article class="blog-post">
                        <h2 class="blog-post-title"><?= $postData->getTitle(); ?></h2>
                        <p class="blog-post-meta"><?= $postData->getDateTime(); ?> by <?= $postData->getUsername(); ?></p>
                        <?php if (!empty($postData->getImage())) { ?>
                            <p><img src="/BloggCms/views/<?= $postData->getImage(); ?>" alt="postimg" style="width:500px;"></p>
                        <?php  } ?>
                        <p><?= $postData->getContent(); ?></p>
                        <?php if (isset($_SESSION['logged_IN']) && $_SESSION['role'] == 'admin') { ?>

                            <form action="/BloggCms/views/editPost.php" method="GET">
                                <input type="hidden" name="id" value=<?= $postData->getId(); ?>>

                                <input type="submit" class="btn-edit" value="Edit">

                            </form>
                            <form action="" method="POST">
                                <input type="hidden" name="Id" value="<?= $postData->getId(); ?>">

                                <input type="submit" class="btn-delete" value="Delete">
                            </form>
                        <?php  } ?>
                        <?php if (isset($_SESSION['logged_IN']) && ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'user')) { ?>


                            <div class="post_comment">

                                <form action="/BloggCms/views/comment.php" method="get">
                                    <input type="hidden" name="Id" value=<?= $postData->getId(); ?> />
                                    <input type="submit" value="comments" class="btn-comment" />
                                </form>
                            </div>
                    <?php

                        }
                    } ?>
                    </article>



            </div>

        </div>

    </main>
</body>

</html>