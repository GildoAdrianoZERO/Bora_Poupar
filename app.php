<?php require 'logica_jogo.php'; ?>

<?php

$porcentagem = ($meta > 0) ? ($totalGuardado / $meta) * 100 : 0;

$larguraBarra = min($porcentagem, 100);


$vitoria = ($totalGuardado >= $meta);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bora Poupar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .transition-width {
            transition: width 1s ease-in-out;
        }


        @keyframes pop {
            0% {
                transform: scale(0.8);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .animate-pop {
            animation: pop 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }
    </style>
</head>

<body class="bg-slate-900 text-white font-sans min-h-screen p-4 flex flex-col items-center relative">

    <?php if ($vitoria): ?>
        <div class="fixed inset-0 bg-black/80 z-50 flex items-center justify-center p-4 backdrop-blur-sm animate-pop">
            <div
                class="bg-slate-800 border-2 border-amber-400 p-8 rounded-2xl max-w-md w-full text-center shadow-[0_0_50px_rgba(251,191,36,0.2)]">
                <div class="text-6xl mb-4">🏆</div>
                <h2 class="text-3xl font-bold text-amber-400 mb-2">META ATINGIDA!</h2>
                <p class="text-slate-300 mb-6">Parabéns, <?= $_SESSION['nome'] ?>! Você juntou todos os <strong
                        class="text-white">R$ <?= number_format($meta, 2, ',', '.') ?></strong>.</p>

                <div class="space-y-3">

                    <a href="nova_meta.php"
                        class="block w-full bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-3 rounded-xl transition transform active:scale-95 shadow-lg">
                        Começar Nova Meta 🔄
                    </a>
                    <button onclick="this.parentElement.parentElement.parentElement.style.display='none'"
                        class="text-slate-500 text-sm hover:text-white underline mt-2">
                        Apenas ver minha cartela completa
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="max-w-6xl w-full">

        <header class="mb-8 border-b border-slate-700 pb-6">

            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Olá, <span class="text-amber-400"><?= $_SESSION['nome'] ?></span>! 👋
                </h1>

                <a href="logout.php"
                    class="bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500/50 px-3 py-1.5 rounded-lg text-xs font-bold transition flex items-center gap-2 hover:text-white group">
                    <span>SAIR</span>
                </a>
            </div>

            <div
                class="flex justify-between items-end mb-4 bg-slate-800/50 p-4 rounded-xl border border-slate-700/50 shadow-sm">

                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <p class="text-slate-400 text-xs font-bold uppercase">Sua Meta</p>

                        <a href="nova_meta.php" title="Alterar valor da meta"
                            class="bg-slate-700 hover:bg-amber-500 text-slate-400 hover:text-white p-1 rounded transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-3 h-3">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                            </svg>
                        </a>
                    </div>
                    <p class="font-mono text-xl text-white tracking-tight">R$ <?= number_format($meta, 2, ',', '.') ?>
                    </p>
                </div>

                <div class="text-right">
                    <p class="text-slate-500 text-xs font-bold uppercase mb-1">Total Guardado</p>
                    <p class="text-3xl font-bold text-emerald-400 font-mono tracking-tight text-shadow">R$
                        <?= number_format($totalGuardado, 2, ',', '.') ?>
                    </p>
                </div>
            </div>

            <div
                class="w-full bg-slate-800 rounded-full h-5 border border-slate-700 relative overflow-hidden shadow-inner mt-2">
                <div class="bg-gradient-to-r from-emerald-600 to-green-400 h-full rounded-full transition-all duration-1000 ease-out flex items-center justify-end pr-2 shadow-[0_0_20px_rgba(16,185,129,0.5)]"
                    style="width: <?= $larguraBarra ?>%">

                    <?php if ($larguraBarra > 12): ?>
                        <span
                            class="text-[10px] font-bold text-black drop-shadow-sm"><?= number_format($porcentagem, 0) ?>%</span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="flex justify-between mt-1 px-1 select-none">
                <span class="text-[10px] text-slate-500">Início</span>
                <span
                    class="text-[10px] text-emerald-500 font-bold tracking-wider"><?= number_format($porcentagem, 1) ?>%
                    CONCLUÍDO</span>
                <span class="text-[10px] text-slate-500">Meta</span>
            </div>

        </header>

        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-2 pb-10">
            <?php foreach ($itens as $indice => $item): ?>
                <?php
                if ($item['pago']) {
                    $cor = 'bg-emerald-600 border-emerald-500 text-white shadow-lg transform scale-95 opacity-90';
                    $conteudo = '<span class="text-xl font-bold">✓</span>';
                } else {
                    $cor = 'bg-slate-800 border-slate-700 text-slate-300 hover:bg-slate-700 hover:border-amber-500 hover:text-white transition-all hover:-translate-y-1';
                    $conteudo = '<span class="text-xs text-slate-500">R$</span> <span class="text-lg font-bold">' . $item['valor'] . '</span>';
                }
                ?>
                <a href="marcar_item.php?index=<?= $indice ?>"
                    class="<?= $cor ?> h-16 rounded-lg border-b-2 flex flex-col items-center justify-center select-none cursor-pointer">
                    <?= $conteudo ?>
                </a>
            <?php endforeach; ?>
        </div>


    </div>
</body>

</html>