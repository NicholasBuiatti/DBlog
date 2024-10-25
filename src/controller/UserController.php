<?php

class UserController
{

    public function login($dati, $conn)
    {
        $username = $dati['username'];
        $password = $dati['password'];

        // Usa una query preparata per evitare SQL injection
        $query = "SELECT * FROM users WHERE username = :username LIMIT 1";
        $data = $conn->prepare($query);
        $data->execute([':username' => $username]);

        // Recupera i dati dell'utente dalla query
        $user = $data->fetch(PDO::FETCH_ASSOC);  // Fetch restituisce un array associativo

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['loggedin'] = true;
            header('Location: ./dashboard.php');
            exit();  // È buona pratica usare exit dopo un redirect
        } else {
            echo 'Password o nome utente non corretti!';
        }
    }
}
