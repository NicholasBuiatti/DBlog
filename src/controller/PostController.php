<?php
// include '../model/Post.php';

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
}
