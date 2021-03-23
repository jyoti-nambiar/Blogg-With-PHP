<?php
include('../includes/header.php');


if (!isset($_SESSION)) {
    header('Location:../index.php');
}  ?>


<?php if (isset($_SESSION) && $_SESSION['role'] == 'user') {
    print_r($_SESSION);
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogg|| Create POST</title>
</head>

<body>

    <form class="formValidator" method="post" action="handlePost.php" enctype="multipart/form-data">
        <h2>Create New Post</h2>

        <input type="hidden" class="text" name="username" value="<?= $_SESSION['username']; ?>">
        <input type="hidden" name="Id" value="<?= $_SESSION['Id']; ?>">

        </div>
        <div class="formControl">
            <label for="username">Title</label>
            <input type="text" class="text" name="title" placeholder="Enter Title">

        </div>

        <div class="formControl">
            <label for="cars">Choose a category:</label>

            <select name="Category" id="category">
                <option value="">Pick one</option>
                <option value="clock">Clock</option>
                <option value="sunglass">Sunglass</option>
                <option value="Furnishing">Furnishing</option>

            </select>

        </div>





        <div class="formControl">
            <textarea name="content" id="" cols="45" rows="10" placeholder="Enter Content">

            </textarea>

        </div>

        <div class="formControl">
            <input type="file" name="imageToUpload" id="">
        </div>
        <label for="submitBtn"></label>
        <input type="submit" value="Create Post" id="submitBtn">


    </form>


</body>


</html>