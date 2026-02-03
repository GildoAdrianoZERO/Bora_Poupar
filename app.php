<?php require 'logica_jogo.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bingo JSON</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-white font-sans min-h-screen p-4 flex flex-col items-center">

    <div class="max-w-6xl w-full"> <header class="flex justify-between items-end mb-8 border-b border-slate-700 pb-4">
            <div>
                <h1 class="text-2xl font-bold">Olá, <span class="text-amber-400"><?= $_SESSION['nome'] ?></span>!</h1>
                <p class="text-slate-400 text-sm mt-1">Meta: <span class="font-mono">R$ <?= number_format($meta, 2, ',', '.') ?></span></p>
            </div>
            <div class="text-right">
                <p class="text-xs text-slate-500 uppercase font-bold">Guardado</p>
                <p class="text-3xl font-bold text-emerald-400 font-mono">R$ <?= number_format($totalGuardado, 2, ',', '.') ?></p>
                <a href="logout.php" class="text-xs text-red-400 hover:underline">Sair</a>
            </div>
        </header>

        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-2">
            
            <?php foreach ($itens as $indice => $item): ?>
                
                <?php 
                    if ($item['pago']) {
                        $cor = 'bg-emerald-600 border-emerald-500 text-white shadow-lg transform scale-95 opacity-90';
                        $conteudo = '<span class="text-xl font-bold">✓</span>'; 
                    } else {
                        $cor = 'bg-slate-800 border-slate-700 text-slate-300 hover:bg-slate-700 hover:border-amber-500 hover:text-white';
                        $conteudo = '<span class="text-xs text-slate-500">R$</span> <span class="text-lg font-bold">' . $item['valor'] . '</span>'; 
                    }
                ?>

                <a href="marcar_item.php?index=<?= $indice ?>" 
                   class="<?= $cor ?> h-16 rounded-lg border-b-2 flex flex-col items-center justify-center transition-all select-none">
                    <?= $conteudo ?>
                </a>

            <?php endforeach; ?>
            
        </div>
    </div>
</body>
</html>