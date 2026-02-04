<?php
// ARQUIVO: nova_meta.php
// Responsabilidade: Alterar a meta do usuário e resetar o jogo para se adaptar.

session_start();
require 'BancoDeDados/conexao_db.php';

// Segurança
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novaMeta = (int)$_POST['meta'];

    if ($novaMeta > 0) {
        $user_id = $_SESSION['user_id'];

        // 1. Atualiza a meta na tabela USERS
        // 2. Define bingo_data como NULL (isso força o logica_jogo.php a criar um novo jogo)
        $sql = "UPDATE users SET meta_alvo = ?, bingo_data = NULL WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute([$novaMeta, $user_id])) {
            // Atualiza a sessão também para refletir na hora
            $_SESSION['meta'] = $novaMeta;
            
            // Manda de volta pro jogo (que vai ser recriado com a nova meta)
            header("Location: app.php");
            exit;
        } else {
            $mensagem = "Erro ao atualizar. Tente novamente.";
        }
    } else {
        $mensagem = "A meta precisa ser maior que zero.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alterar Meta</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-white font-sans min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full bg-slate-800 p-8 rounded-2xl border border-slate-700 shadow-2xl">
        <h2 class="text-2xl font-bold text-amber-400 mb-2">Mudar Meta Financeira 🎯</h2>
        <p class="text-slate-400 text-sm mb-6">
            Atenção: Ao mudar sua meta, seu jogo atual será <strong class="text-red-400">reiniciado</strong> e uma nova cartela será gerada.
        </p>

        <?php if($mensagem): ?>
            <div class="bg-red-500/10 text-red-400 p-3 rounded mb-4 text-sm text-center border border-red-500/20">
                <?= $mensagem ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-4">
            <div>
                <label class="text-xs font-bold text-slate-500 uppercase">Nova Meta (R$)</label>
                <input type="number" name="meta" required placeholder="Ex: 5000" 
                       class="w-full bg-slate-900 border border-slate-600 rounded-lg p-3 text-white focus:border-amber-400 outline-none transition mt-1 font-mono text-lg">
            </div>

            <div class="flex gap-3 pt-2">
                <a href="app.php" class="flex-1 py-3 text-center text-slate-400 hover:text-white transition text-sm font-bold border border-slate-700 rounded-lg hover:bg-slate-700">
                    CANCELAR
                </a>
                <button type="submit" class="flex-1 bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 rounded-lg transition shadow-lg shadow-amber-500/20">
                    SALVAR NOVA META
                </button>
            </div>
        </form>
    </div>

</body>
</html>