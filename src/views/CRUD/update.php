<?php
require '../../../config/database.php';
require '../../model/Post.php';
require '../../model/Category.php';
require '../../controller/PostController.php';
session_start();

// Retrieve the post ID from the query string
$postId = isset($_GET['id']) ? (int)$_GET['id'] : null;

$postDetails = null;
if ($postId) {
    $postModel = new Post();
    $postDetails = $postModel->getPostById($conn, $postId);
}

$allCat = new Category();
$categories = $allCat->allCategories($conn);

$postController = new PostController();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $dati = $_POST;
    $result = $postController->validateSave($dati, $conn, true);

    if (is_array($result)) {
        // Se ci sono errori, gestiscili
        foreach ($result as $error) {
            echo "<p class='error'>$error</p>";
        }
    } elseif ($result !== false) {
        // Se il post è stato creato con successo
        // header("Location: show.php?id=" . $result);
        header("Location: ../dashboard.php");
        exit;
    } else {
        // Se c'è stato un errore ma non ci sono errori specifici
        echo "<p class='error'>Errore durante la creazione del post.</p>";
    }
}

include '../Components/header.php';
?>


<div class="container">
    <h2 class="text-center mb-4">Modifica di: <?= $postDetails['title']  ?></h2>
    <form method="POST">
        <input type="hidden" name="update" value="1">
        <input type="hidden" name="user_id" value="<?= $_SESSION['user_id']; ?>" />
        <div class="form-group">
            <label for="title">Nuovo titolo</label>
            <input type="text" class="form-control" id="title" name="title" required placeholder="<?= $postDetails['title']  ?>">
        </div>

        <div class="form-group">
            <label for="content">Contenuto</label>
            <textarea class="form-control" id="content" name="content" rows="5" required placeholder="<?= $postDetails['content']  ?>"></textarea>
        </div>

        <div class="form-group">
            <label for="image">Immagine</label>
            <img src="<?= $postDetails['image'] ?>" alt="">
            <input type="file" class="form-control" id="image" name="image">
        </div>

        <div class="form-group">
            <label for="category">Categoria</label>
            <select class="form-control" id="category" name="category_id" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>" <?= ($category['id'] == $postDetails['category_id']) ? 'selected' : '' ?>>
                        <?= $category['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Modifica</button>
    </form>
    <pre><?php print_r($postDetails); ?></pre>
</div>

<?php include '../Components/footer.php' ?>