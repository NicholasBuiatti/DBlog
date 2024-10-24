<?php
require_once __DIR__ . '/../model/Post.php';
// session_start();
class PostController
{
    function getUserPosts($conn)
    {
        // Controlla se l'utente è loggato
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id']; // Recupera l'ID utente dalla sessione
            $allPostsUser = new Post();
            return $allPostsUser->getUserPosts($user_id, $conn); // Restituisce i post dell'utente
        } else {
            // Reindirizza l'utente a una pagina di login se non è loggato
            header("Location: /path/to/login.php");
            exit();
        }
    }

    function validateCreate($dati, $conn)
    {
        $title = $dati['title'];
        $content = $dati['content'];
        $image = isset($dati['image']) ? $dati['image'] : null;
        $category_id = (int) $dati['category_id'];
        $user_id = $dati['user_id']; // Accesso corretto alla sessione

        $errors = [];

        if (empty($title)) {
            $errors[] = "Il titolo è obbligatorio.";
        }
        if (empty($content)) {
            $errors[] = "La descrizione è obbligatoria.";
        }
        if (empty($category_id)) {
            $errors[] = "La categoria è obbligatoria.";
        }

        try {
            $save = new Post();
            $result = $save->create($conn, $title, $content, $image, $category_id, $user_id);
            return $result; //restituisci il mio nuovo oggetto
        } catch (Exception $e) {
            return ["Errore durante il salvataggio del post: " . $e->getMessage()];
        }
    }
}
