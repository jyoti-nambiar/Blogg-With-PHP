<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Bootstrap cdn-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>BLOGG||Home</title>
</head>

<body>
    <?php
    include "includes/header.php"; ?>
    <main class="container">
        <div class="p-4 p-md-5 mb-4 text-white rounded bg-primary">
            <div class="col-md-6 px-0">
                <h1 class="display-4 fst-italic">Title of a longer featured blog post</h1>
                <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what’s most interesting in this post’s contents.</p>
                <p class="lead mb-0"><a href="#" class="text-white fw-bold">Continue reading...</a></p>
            </div>
        </div>
    </main>
    <?php
    include "includes/footer.php"; ?>
</body>

</html>