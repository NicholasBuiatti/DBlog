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
        $data->bindParam(':image', $image);
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
        $query = 'SELECT posts.*, users.username, categories.name
        FROM posts
        JOIN users ON posts.user_id = users.id
        JOIN categories ON posts.category_id = categories.id
        WHERE posts.id = :id';
        $data = $conn->prepare($query);
        $data->execute([':id' => $postId]);

        return $data->fetch(PDO::FETCH_ASSOC);
    }

    //UPDATE
    public function update($conn, $post_id, $title, $content, $image, $category_id, $user_id)
    {
        try {
            // Creiamo una query SQL per aggiornare i dati del post
            $sql = "UPDATE posts 
                    SET title = :title, content = :content, image = :image, 
                        category_id = :category_id, user_id = :user_id 
                    WHERE id = :post_id";

            // Prepariamo la query
            $data = $conn->prepare($sql);

            // Associa i valori ai parametri
            $data->bindParam(':title', $title);
            $data->bindParam(':content', $content);
            $data->bindParam(':image', $image);
            $data->bindParam(':category_id', $category_id);
            $data->bindParam(':user_id', $user_id);
            $data->bindParam(':post_id', $post_id);
            var_dump($title, $content, $image, $category_id, $user_id, $post_id);
            // Esegui l'aggiornamento
            $data->execute();
        } catch (Exception $e) {
            // Ritorna un messaggio di errore se qualcosa va storto
            return ["success" => false, "message" => "Errore durante l'aggiornamento del post: " . $e->getMessage()];
        }
    }

    //DELETE
    public function delete($conn, $post_id)
    {
        try {
            // Creiamo una query SQL per eliminare il post
            $sql = "DELETE FROM posts WHERE id = :post_id";

            // Prepariamo la query
            $data = $conn->prepare($sql);

            // Associa il valore al parametro
            $data->bindParam(':post_id', $post_id);

            // Esegui l'eliminazione
            $data->execute();

            // Ritorna un messaggio di successo
            return ["success" => true, "message" => "Post eliminato con successo."];
        } catch (Exception $e) {
            // Ritorna un messaggio di errore se qualcosa va storto
            return ["success" => false, "message" => "Errore durante l'eliminazione del post: " . $e->getMessage()];
        }
    }
}
