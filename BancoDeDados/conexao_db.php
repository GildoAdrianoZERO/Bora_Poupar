<?php
$host = 'localhost';
$db = 'bingo_db';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;chatset=utf8", $user, $pass);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
die("erro de conexao ". $e->getMessage());
}

?>