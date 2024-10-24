<?php
// session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout'])) {
    // Distruggi la sessione
    session_unset(); // Rimuove tutte le variabili di sessione
    session_destroy(); // Distrugge la sessione

    // Reindirizza l'utente alla pagina di login
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyBlog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body style="background: linear-gradient(135deg, #e0e0e0, #c0c0c0); color: #333; font-family: Arial, sans-serif;">

    <nav class="navbar" style="background-color: #b0b0b0;">
        <div class="container-fluid">
            <a class="navbar-brand fs-2" href="#">MyBlog</a>
            <ul class="navbar-nav flex-row color-dark">
                <li class="nav-item mx-2 text-decoration-none">
                    <a href="../dashboard.php" class="btn btn-primary text-decoration-none text-black">Dashboard</a>
                </li>
                <li class="nav-item mx-2">
                    <a href="../CRUD/create.php" class="btn btn-primary text-decoration-none text-black">Crea</a>
                </li>
                <li class="nav-item mx-2">
                    <form method="POST" style="display: inline;">
                        <input type="hidden" name="logout" value="1">
                        <button type="submit" name="logout" class="btn btn-primary" style="color: black; text-decoration: none;">Disconnetti</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>