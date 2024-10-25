<?php
require '../../../config/database.php';
require '../../model/Post.php';
session_start();

// Retrieve the post ID from the query string
$postId = isset($_GET['id']) ? (int)$_GET['id'] : null;

$postDetails = null;
if ($postId) {
    $postModel = new Post();
    $postDetails = $postModel->getPostById($conn, $postId);
}

include '../Components/header.php';
?>

<div class="container">
    <a href="../dashboard.php" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i></a>
    <?php if ($postDetails): ?>
        <div class="row">
            <div class="col-6">
                <img src="<?= $postDetails['image'] ?>" alt="Post Image" class="img-fluid">
            </div>
            <div class="col-6">
                <h1><?= $postDetails['title'] ?></h1>
                <p>Categoria: <?= $postDetails['name'] ?></p>
            </div>
        </div>
        <hr>
        <p><?= $postDetails['content'] ?></p>
    <?php else: ?>
        <h1 class="error text-center">Post non trovato.</h1>
    <?php endif; ?>

    <!-- <pre><?php print_r($postDetails); ?></pre> -->
</div>

<?php include '../Components/footer.php'; ?>