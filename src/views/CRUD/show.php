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
    <?php if ($postDetails): ?>
        <h1>Titolo: <?= $postDetails['title'] ?></h1>
        <p><?= $postDetails['content'] ?></p>
        <img src="<?= $postDetails['image'] ?>" alt="Post Image" class="img-fluid">
        <p>Categoria: <?= $postDetails['name'] ?></p>
        <p>Autore: <?= $postDetails['username'] ?></p>
    <?php else: ?>
        <p class="error">Post non trovato.</p>
    <?php endif; ?>

    <!-- <pre><?php print_r($postDetails); ?></pre> -->
</div>

<?php include '../Components/footer.php'; ?>