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
}
