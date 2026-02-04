<?php
session_start();
require 'BancoDeDados/conexao_db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION['user_id'];


$stmt = $pdo->prepare("UPDATE users SET bingo_data = NULL WHERE id = ?");
$stmt->execute([$user_id]);

header("Location: app.php");
exit;
?>