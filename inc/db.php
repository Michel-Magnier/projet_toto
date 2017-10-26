<?php

$dsn = "mysql:dbname={$config['DB_DATABASE']};host={$config['DB_HOST']};charset=UTF8";
$user = "{$config['DB_USER']}";
$password = "{$config['DB_PASSWORD']}";

try {
    // Je crée une instance de PDO
    $pdo = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

?>
