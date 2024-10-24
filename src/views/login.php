<?php
require '../../config/database.php';
require '../controller/UserController.php';

$userController = new UserController();

//faccio partire il login all'invio dei dati
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userController->login($_POST, $conn);
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <section class="vh-100 bg-dark text-white">
        <div class="text-center pt-3">
            <h1 class="">Benvenuto nel tuo Blog personale</h1>
            <p>Inserisci la tua password per accedervi</p>
        </div>

        <div class="col-6 offset-3 mt-4 border border-1 rounded border-white">
            <form method="POST" class="p-3">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username*</label>
                    <input type="text" name="username" class="form-control" id="exampleInputEmail1" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password*</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Ricordami</label>
                </div>
                <button type="submit" class="btn btn-primary">Entra</button>
            </form>
        </div>

    </section>
</body>

</html>