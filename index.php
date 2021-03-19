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
                <h1 class="display-4 fst-italic">The latest trends in fashion and furnishing!</h1>
                <p class="lead my-3">Welcome all to our blog, here you will find the latest trends in fashion and furnishing, from your very own shop Millhouse, Now shop even online with our new segment of Webshop. </p>
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
                        <?php  } ?>
                        <?php if (isset($_SESSION['logged_IN']) && ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'user')) { ?>
                            <div class="post_comment">

                                <form action="views/comment.php" method="get">
                                    <input type="hidden" name="Id" value=<?= $postData->getId(); ?> />
                                    <input type="submit" value="comments" class="btn-comment" />
                                </form>
                            </div>
                    <?php  }
                    } ?>
                    </article>



            </div>
            <div class="col-md-4">
                <div class="p-4 mb-3 bg-light rounded">
                    <h4 class="fst-italic">About</h4>
                    <p class="mb-0"><span>Millhouse</span> is a wholesale company that sells clothing, accessories and small furnishings to fashion and lifestyle stores.Having been in the industry since 2000, we are one of the trusted brand that our customers rely when it comes to quality and affordable products.Our Mission & Vision is to provide best valued products to our customers. We provide top brands to our customers, and enable our brand partners to reach the widest audience along with 14 Days Money Back Guarantee & 365 days Returns.
                    </p>

                    <p> Millhouse have now plan to reach to you with its new onine e-commerce store, a continuously evolving shopping center online.Just like a shopping center,theres is always something fresh and exciting.With our range of options in <em>Clocks</em>, <em>sunglasses &</em>
                        <em>smaller furnishings</em>, We continue to give high quality service and long standing commitment to our customers.Follow us on our new and latest updates on our
                        and connect with us to let us know what would you like to see and share your experiences with us to serve you better.

                    </p>

                    <p> Millhouse has annual sales of SEK 75 million and 50 employees, mainly within administration, purchasing and inventory management, and we are expanding our team with our new online store to give you a whole new experience of online shopping.</p>

                    </p>

                    </p>
                </div>


            </div>
        </div>
    </main>


    <?php
    include("includes/footer.php");  ?>

</body>

</html>