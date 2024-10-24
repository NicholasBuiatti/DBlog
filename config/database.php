<?php

$host = 'localhost';
$dbname = 'dbblog';
$username_db = 'root';
$password_db = '1243a';

try {
    // Connessione al database con PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username_db, $password_db);
    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connessione al database fallita: " . $e->getMessage();
    exit();  // Esci se la connessione fallisce
}
