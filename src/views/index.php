<?php
require '../../config/database.php';
require '../model/Post.php';

$allPosts = new Post();
$posts = $allPosts->getAllPosts($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body style="background: linear-gradient(135deg, #e0e0e0, #c0c0c0); color: #333; font-family: Arial, sans-serif;">
    <nav class=" navbar" style="background-color: #b0b0b0;">
        <div class="container-fluid">
            <a class="navbar-brand fs-2" href="#">MyBlog</a>
            <ul class="navbar-nav flex-row color-dark">
                <li class="nav-item mx-2">
                    <a href="./login.php" class="btn btn-primary">Login</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- SEZIONE PER I POSTS -->
    <article class="container mt-4">
        <ul class="list-unstyled">
            <?php foreach ($posts as $post): ?>
                <li>
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="..." class="img-fluid rounded-start">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $post['title'] ?></h5>
                                    <p class="card-text"><?= $post['content'] ?></p>
                                    <p class="card-text"><small class="text-muted"><?= $post['created_at'] ?></small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </article>
</body>

</html>