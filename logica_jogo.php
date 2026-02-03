<?php
// ARQUIVO: logica_jogo.php
// ESTRATÉGIA: JSON Storage (Muitos itens, 1 linha no banco)

session_set_cookie_params(0);
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

require 'BancoDeDados/conexao_db.php';

$user_id = $_SESSION['user_id'];
$meta    = (int)$_SESSION['meta'];

// 1. BUSCAR O JOGO (Agora buscamos na tabela USERS)
$stmt = $pdo->prepare("SELECT bingo_data FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$jogoSalvo = $user['bingo_data']; // Isso é um texto JSON

// 2. SE NÃO TIVER JOGO, CRIA UM NOVO
if (empty($jogoSalvo)) {
    
    $novoJogo = [];
    $saldoRestante = $meta;
    $notasPermitidas = [5, 10, 20, 50, 100, 200];
    
    // --- LÓGICA ALEATÓRIA PURA (SEM PRIORIZAR) ---
    // Enquanto faltar dinheiro...
    while ($saldoRestante >= 5) {
        
        // A. Filtra: Quais notas cabem no bolso?
        // Isso evita que a gente tente sortear 200 se só falta 50.
        $notasValidas = array_filter($notasPermitidas, function($n) use ($saldoRestante) {
            return $n <= $saldoRestante;
        });
        
        // Se travou (ex: falta 3 reais e a menor nota é 5), para o loop.
        if (empty($notasValidas)) break;

        // B. Sorteia qualquer uma das válidas (Chance igual para 5 ou 200)
        $notaSorteada = $notasValidas[array_rand($notasValidas)];
        
        // C. Adiciona na estrutura do JSON
        // Guardamos o valor e o status (pago: false)
        $novoJogo[] = [
            'valor' => $notaSorteada,
            'pago'  => false
        ];
        
        $saldoRestante -= $notaSorteada;
    }
    
    // Embaralha para ficar bonito na tela
    shuffle($novoJogo);

    // 3. SALVA COMO JSON (A Mágica ✨)
    // Transformamos o Array gigante num texto e salvamos numa única coluna
    $jsonParaSalvar = json_encode($novoJogo);
    
    $update = $pdo->prepare("UPDATE users SET bingo_data = ? WHERE id = ?");
    $update->execute([$jsonParaSalvar, $user_id]);
    
    // Recarrega
    header("Location: app.php");
    exit;
}

// 4. PREPARA DADOS PARA O APP
// Se já existe, transformamos o texto JSON de volta em Array PHP para usar
$itens = json_decode($jogoSalvo, true);

// Calcula total
$totalGuardado = 0;
foreach ($itens as $item) {
    if ($item['pago']) {
        $totalGuardado += $item['valor'];
    }
}
?>