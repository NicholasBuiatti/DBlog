<?php
require '../../../config/database.php';
require '../../controller/PostController.php';
require '../../model/Category.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Se non è loggato, reindirizza alla pagina index.php
    header("Location: ../index.php");
    exit();
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
    <div class="row justify-content-between mb-4">
        <h2 class="text-center col-10 mb-0">Crea un Nuovo Post</h2>
        <a href="../dashboard.php" class="btn btn-primary" style="width: 3rem;"><i class="fa-solid fa-arrow-left"></i></a>

    </div>
    <form method="POST">
        <input type="hidden" name="create" value="1">
        <input type="hidden" name="user_id" value="<?= $_SESSION['user_id']; ?>" />

        <div class="form-group my-2">
            <label for="title">Titolo</label>
            <input type="text" class="form-control" id="title" name="title" required placeholder="Inserisci il titolo">
        </div>

        <div class="form-group my-2">
            <label for="content">Contenuto</label>
            <textarea class="form-control" id="content" name="content" rows="5" required placeholder="Scrivi il contenuto qui..."></textarea>
        </div>

        <div class="form-group my-2">
            <label for="image">URL Immagine</label>
            <input type="text" class="form-control" id="image" name="image" placeholder="Inserisci l'URL dell'immagine">
        </div>

        <div class="form-group my-2">
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

        <button type="submit" class="btn btn-success btn-block mt-3">Aggiungi</button>
    </form>
</div>
<!-- <pre><?php print_r($_SESSION); ?></pre> -->
<?php include '../Components/footer.php' ?>