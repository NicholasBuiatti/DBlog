<?php

class Post
{

    function getAllPosts($conn)
    {
        $query = 'SELECT * FROM posts';
        $data = $conn->prepare($query);
        $data->execute();

        $posts = $data->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }

    function getUserPosts($user_id, $conn)
    {
        $query = 'SELECT * FROM posts WHERE user_id = :user_id';
        $data = $conn->prepare($query);
        $data->execute([':user_id' => $user_id]);

        $userPosts = $data->fetchAll(PDO::FETCH_ASSOC);
        return $userPosts;
    }

    //funzione per salvare i dati nel db
    function create($conn, $title, $content, $image, $category_id, $user_id)
    {
        $query = "INSERT INTO posts (title, content, image, category_id, user_id) VALUES (:title, :content, :image, :category_id, :user_id)";
        $data = $conn->prepare($query);

        // Associa i parametri
        $data->bindParam(':title', $title);
        $data->bindParam(':content', $content);
        if ($image) {
            $data->bindParam(':image', $image);
        }
        $data->bindParam(':category_id', $category_id);
        $data->bindParam(':user_id', $user_id); // Associa user_id

        // Esegui la query e gestisci il risultato
        try {
            if ($data->execute()) {
                return $conn->lastInsertId(); // Restituisce l'ID dell'ultimo inserimento
            } else {
                return false; // Ritorna false se l'inserimento fallisce
            }
        } catch (PDOException $e) {
            // Gestisci eventuali errori
            echo "Errore durante l'inserimento: " . $e->getMessage();
            return false;
        }
    }

    //SHOW
    function getPostById($conn, $postId)
    {
        $query = 'SELECT posts.*, users.username, categories.name AS category_name
        FROM posts
        JOIN users ON posts.user_id = users.id
        JOIN categories ON posts.category_id = categories.id
        WHERE posts.id = :id';
        $data = $conn->prepare($query);
        $data->execute([':id' => $postId]);

        return $data->fetch(PDO::FETCH_ASSOC);
    }
}
