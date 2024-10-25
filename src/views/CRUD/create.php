<?php
require '../../../config/database.php';
require '../../controller/PostController.php';
require '../../model/Category.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$allCat = new Category();
$categories = $allCat->allCategories($conn);


$postController = new PostController();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    $dati = $_POST;
    $result = $postController->validateSave($dati, $conn);

    if (is_array($result)) {
        // Se ci sono errori, gestiscili
        foreach ($result as $error) {
            echo "<p class='error'>$error</p>";
        }
    } elseif ($result !== false) {
        // Se il post è stato creato con successo
        header("Location: show.php?id=" . $result);
        exit;
    } else {
        // Se c'è stato un errore ma non ci sono errori specifici
        echo "<p class='error'>Errore durante la creazione del post.</p>";
    }
}

?>

<?php include '../Components/header.php' ?>

<div class="container">
    <h2 class="text-center mb-4">Crea un Nuovo Post</h2>
    <form method="POST">
        <input type="hidden" name="create" value="1">
        <input type="hidden" name="user_id" value="<?= $_SESSION['user_id']; ?>" />

        <div class="form-group">
            <label for="title">Titolo</label>
            <input type="text" class="form-control" id="title" name="title" required placeholder="Inserisci il titolo">
        </div>

        <div class="form-group">
            <label for="content">Contenuto</label>
            <textarea class="form-control" id="content" name="content" rows="5" required placeholder="Scrivi il contenuto qui..."></textarea>
        </div>

        <div class="form-group">
            <label for="image">URL Immagine</label>
            <input type="text" class="form-control" id="image" name="image" placeholder="Inserisci l'URL dell'immagine">
        </div>

        <div class="form-group">
            <label for="category">Categoria</label>
            <select class="form-control" id="category" name="category_id" required>
                <option disabled selected>Seleziona una categoria</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>">
                        <?= $category['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Crea Post</button>
    </form>
</div>
<pre><?php print_r($_SESSION); ?></pre>
<?php include '../Components/footer.php' ?>