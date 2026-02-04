<?php

session_set_cookie_params(0);
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

require 'BancoDeDados/conexao_db.php';

$user_id = $_SESSION['user_id'];
$meta    = (int)$_SESSION['meta'];


$stmt = $pdo->prepare("SELECT bingo_data FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$jogoSalvo = $user['bingo_data']; 

if (empty($jogoSalvo)) {
    
    $novoJogo = [];
    $saldoRestante = $meta;
    $notasPermitidas = [5, 10, 20, 50, 100, 200];
    
   
    while ($saldoRestante >= 5) {
        
        
        $notasValidas = array_filter($notasPermitidas, function($n) use ($saldoRestante) {
            return $n <= $saldoRestante;
        });
        
        
        if (empty($notasValidas)) break;

        
        $notaSorteada = $notasValidas[array_rand($notasValidas)];
        
        $novoJogo[] = [
            'valor' => $notaSorteada,
            'pago'  => false
        ];
        
        $saldoRestante -= $notaSorteada;
    }
    
    shuffle($novoJogo);

    
    $jsonParaSalvar = json_encode($novoJogo);
    
    $update = $pdo->prepare("UPDATE users SET bingo_data = ? WHERE id = ?");
    $update->execute([$jsonParaSalvar, $user_id]);
    
    header("Location: app.php");
    exit;
}


$itens = json_decode($jogoSalvo, true);


$totalGuardado = 0;
foreach ($itens as $item) {
    if ($item['pago']) {
        $totalGuardado += $item['valor'];
    }
}
?>