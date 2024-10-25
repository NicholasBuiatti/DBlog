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


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['destroy'])) {
    $destroy = $postController->deletePost($conn, $_POST['destroy']);
}
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
                            <img src="<?= $post['image'] ?>" class="img-fluid rounded-start">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?= $post['title'] ?></h5>
                                <p class="card-text"><?= $post['content'] ?></p>
                                <div class="row justify-content-between align-items-center">
                                    <p class="card-text col-3 mb-0"><small class="text-muted"><?= $post['created_at'] ?></small></p>
                                    <div class="col-6 row text-end">
                                        <a href="./CRUD/update.php?id=<?php echo $post['id']; ?>" class="col btn btn-warning">Modifica</a>
                                        <a href="./CRUD/show.php?id=<?php echo $post['id']; ?>" class="mx-2 col btn btn-info">Info</a>
                                        <form action="" method="POST" class="col p-0">
                                            <input type="hidden" name='destroy' value="<?= $post['id'] ?>">
                                            <button type="submit" class="btn btn-danger">Cancella</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</article>

<pre><?php print_r($posts); ?></pre>

<?php include './Components/footer.php' ?>