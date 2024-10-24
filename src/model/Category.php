<?php

class Category
{

    function allCategories($conn)
    {
        $query = 'SELECT * FROM categories';
        $data = $conn->prepare($query);
        $data->execute();

        $categories = $data->fetchAll(PDO::FETCH_ASSOC);
        return $categories;
    }
}
