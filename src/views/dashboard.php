<?php
session_start();
require '../../config/database.php';
require '../model/Category.php';
require '../controller/PostController.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Se non è loggato, reindirizza alla pagina index.php
    header("Location: index.php");
    exit();
}

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
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-4">
                                        <p class="card-text">Categoria: <?= $post['name'] ?></p>
                                        <p class="card-text mb-0"><small class="text-muted">Creato il: <?= $post['created_at'] ?></small></p>
                                    </div>
                                    <div class="col-2 row text-end">
                                        <div>
                                            <a href="./CRUD/update.php?id=<?php echo $post['id']; ?>" class=" btn btn-warning"><i class="fa-solid fa-pen"></i></a>
                                        </div>
                                        <div class="my-2">
                                            <a href="./CRUD/show.php?id=<?php echo $post['id']; ?>" class=" btn btn-info"><i class="fa-solid fa-magnifying-glass"></i></a>
                                        </div>
                                        <form action="" method="POST" class="">
                                            <input type="hidden" name='destroy' value="<?= $post['id'] ?>">
                                            <button type="submit" class=" btn btn-danger"><i class="fa-solid fa-trash"></i></button>
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

<!-- <pre><?php print_r($posts); ?></pre> -->

<?php include './Components/footer.php' ?>