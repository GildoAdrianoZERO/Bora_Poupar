<?php
// ARQUIVO: marcar_item.php (Versão JSON)

session_start();
if (!isset($_SESSION['user_id'])) { header("Location: index.php"); exit; }

require 'BancoDeDados/conexao_db.php';

// Verificamos se recebeu o índice (0, 1, 2...)
if (isset($_GET['index'])) {
    $index = (int)$_GET['index'];
    $user_id = $_SESSION['user_id'];

    // 1. Pega o JSON atual
    $stmt = $pdo->prepare("SELECT bingo_data FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $user['bingo_data']) {
        // 2. Decodifica para Array PHP
        $itens = json_decode($user['bingo_data'], true);

        // 3. Verifica se o índice existe nesse array
        if (isset($itens[$index])) {
            // 4. Inverte o valor (Toggle)
            $itens[$index]['pago'] = !$itens[$index]['pago'];

            // 5. Codifica e Salva de volta
            $novoJson = json_encode($itens);
            $update = $pdo->prepare("UPDATE users SET bingo_data = ? WHERE id = ?");
            $update->execute([$novoJson, $user_id]);
        }
    }
}

header("Location: app.php");
exit;
?>