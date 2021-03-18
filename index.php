<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Bootstrap cdn-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="icon" type="image/png" sizes="16x16" href="Images/favicon-16x16.png">

    <title>BLOGG||Home</title>

</head>

<body>

    <?php
    include("includes/header.php"); ?>

    <?php include('includes/database_connect.php');

    ?>
    <main class="container">
        <div class="p-4 p-md-5 mb-4 text-white rounded" style=" background-color: #383838;">
            <div class="col-md-6 px-0">
                <h1 class="display-4 fst-italic">Title of a longer featured blog post</h1>
                <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what’s most interesting in this post’s contents.</p>
                <p class="lead mb-0"><a href="#" class="text-white fw-bold">Continue reading...</a></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <h3 class="pb-4 mb-4 fst-italic border-bottom">
                    From the Firehose
                </h3>

                <?php
                if (isset($_GET['info']) && $_GET['info'] == 'updated') {
                    $updateMsg = "The post has been updated";
                    echo "<p class='success'>$updateMsg </p>";
                }
                if (isset($_GET['info']) && $_GET['info'] == 'deleted') {
                    $updateMsg = "The post has been deleted";
                    echo "<p class='error'>$updateMsg </p>";
                }

                if (isset($_POST['Id'])) {
                    print_r($_POST);
                    $postId = $_POST['Id'];
                    $query = "DELETE FROM posts WHERE Id=$postId";
                    $statement = $conn->prepare($query);
                    if ($statement->execute()) {
                        header('Location:index.php?info=deleted');
                    } else {
                        echo "Post is not deleted";
                    }
                }
                ?>

                <?php
                include('Classes/post.php');
                $sql = "SELECT * FROM posts ORDER BY Id DESC";
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

                            <div class="post_comment">

                                <form action="views/comment.php" method="get">
                                    <input type="hidden" name="Id" value=<?= $postData->getId(); ?> />
                                    <input type="submit" value="comments" class="btn-comment" />
                                </form>
                            </div>
                        <?php  } ?>
                    </article>

                <?php  } ?>

            </div>
            <div class="col-md-4">
                <div class="p-4 mb-3 bg-light rounded">
                    <h4 class="fst-italic">About</h4>
                    <p class="mb-0">Saw you downtown singing the Blues. Watch you circle the drain. Why don't you let me stop by? Heavy is the head that <em>wears the crown</em>. Yes, we make angels cry, raining down on earth from up above.

                    </p>
                </div>


            </div>
        </div>
    </main>


    <?php
    include "includes/footer.php"; ?>

</body>

</html>