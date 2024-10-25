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

    //VALIDAZIONE METODO CREATE
    function validateSave($dati, $conn, $isUpdate = false)
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

        if (!empty($errors)) {
            return $errors;
        }

        try {
            $post = new Post();

            // Verifica se è un'operazione di aggiornamento o creazione
            if ($isUpdate) {
                // Assumi che $dati contenga anche l'id del post da aggiornare
                $post_id = $dati['id'];
                $result = $post->update($conn, $post_id, $title, $content, $image, $category_id, $user_id);
            } else {
                $result = $post->create($conn, $title, $content, $image, $category_id, $user_id);
            }

            return $result;
        } catch (Exception $e) {
            return ["Errore durante il salvataggio del post: " . $e->getMessage()];
        }
    }

    function deletePost($conn, $post_id)
    {
        try {
            $post = new Post();
            $result = $post->delete($conn, $post_id);

            if ($result['success']) {
                header("Location: ./dashboard.php");
                exit();
            } else {
                echo $result['message'];
            }
        } catch (Exception $e) {
            echo "Errore durante l'eliminazione del post: " . $e->getMessage();
        }
    }
}
