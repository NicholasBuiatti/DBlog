<?php
session_start();
require '../../config/database.php';
require '../model/Category.php';
require '../controller/PostController.php';

// Crea un'istanza del PostController
$postController = new PostController();
// Ottieni i post dell'utente passando la connessione
$posts = $postController->getUserPosts($conn);


$allCat = new Category();
$categories = $allCat->allCategories($conn);
?>

<?php include './Components/header.php' ?>

<h1 class="text-center">Benvenuto nella tua Dashboard <?= $_SESSION['username'] ?></h1>

<!-- SEZIONE PER LE CATEGORIE -->
<section class="container">
    <ul class="list-inline text-center">
        <?php foreach ($categories as $category) { ?>
            <li class="list-inline-item">
                <span class="badge rounded-pill bg-primary"><?php echo $category['name'] ?></span>
            </li>
        <?php } ?>
    </ul>
</section>

<!-- <pre><?php print_r($categories); ?></pre> -->

<!-- SEZIONE PER I POSTS -->
<article class="container">
    <h2>Ecco i tuoi posts</h2>
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

<!-- <pre><?php print_r($posts); ?></pre> -->

<?php include './Components/footer.php' ?>