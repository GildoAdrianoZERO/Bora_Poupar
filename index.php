<?php require 'auth_logic.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bora Poupar - Acesso</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .fade-in { animation: fadeIn 0.5s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center p-4 font-sans text-white">

    <div class="w-full max-w-md bg-slate-800 p-8 rounded-2xl shadow-2xl border border-slate-700">
        
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-amber-400 tracking-wider">BORA POUPAR</h1>
            <p class="text-slate-400 text-sm mt-2">Sua economia gamificada.</p>
        </div>

        <?php if(isset($erro) && $erro): ?>
            <div class="mb-4 p-3 bg-red-900/30 border border-red-500/50 rounded-lg text-red-300 text-sm text-center font-medium animate-pulse">
                ⚠️ <?= $erro ?>
            </div>
        <?php endif; ?>
        
        <?php if(isset($sucesso) && $sucesso): ?>
            <div class="mb-4 p-3 bg-emerald-900/30 border border-emerald-500/50 rounded-lg text-emerald-300 text-sm text-center font-medium">
                ✅ <?= $sucesso ?>
            </div>
        <?php endif; ?>

        <form method="POST" id="authForm" class="space-y-4">
            <input type="hidden" name="acao" id="acaoInput" value="login">

            <div id="cadastroFields" class="hidden space-y-4 fade-in">
                <div>
                    <label class="block text-xs text-slate-400 mb-1 ml-1 font-semibold uppercase">Nome Completo</label>
                    <input type="text" name="full_name" 
                           value="<?= htmlspecialchars($_POST['full_name'] ?? '') ?>"
                           class="w-full bg-slate-900 border border-slate-600 rounded-lg p-3 text-white focus:border-amber-400 outline-none transition placeholder-slate-600" placeholder="Como quer ser chamado?">
                </div>
                <div>
                    <label class="block text-xs text-amber-400 mb-1 ml-1 font-bold uppercase">Meta Financeira (R$)</label>
                    <input type="number" name="meta" 
                           value="<?= htmlspecialchars($_POST['meta'] ?? '') ?>"
                           class="w-full bg-slate-900 border border-amber-500/50 rounded-lg p-3 text-white focus:border-amber-400 outline-none transition placeholder-slate-600" placeholder="Ex: 5000">
                </div>
            </div>

            <div>
                <label class="block text-xs text-slate-400 mb-1 ml-1 font-semibold uppercase">E-mail</label>
                <input type="email" name="email" required 
                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                       class="w-full bg-slate-900 border border-slate-600 rounded-lg p-3 text-white focus:border-amber-400 outline-none transition placeholder-slate-600" placeholder="seu@email.com">
            </div>

            <div class="relative">
                <label class="block text-xs text-slate-400 mb-1 ml-1 font-semibold uppercase">Senha</label>
                <div class="relative">
                    <input type="password" name="password" id="senhaInput" required class="w-full bg-slate-900 border border-slate-600 rounded-lg p-3 text-white focus:border-amber-400 outline-none transition placeholder-slate-600 pr-10" placeholder="******">
                    
                    <button type="button" onclick="toggleSenha('senhaInput')" class="absolute right-3 top-3 text-slate-500 hover:text-white transition" title="Ver senha">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </button>
                </div>
            </div>

            <div id="confirmField" class="hidden fade-in relative">
                <label class="block text-xs text-slate-400 mb-1 ml-1 font-semibold uppercase">Confirmar Senha</label>
                <div class="relative">
                    <input type="password" name="confirm_password" id="confirmaInput" class="w-full bg-slate-900 border border-slate-600 rounded-lg p-3 text-white focus:border-amber-400 outline-none transition placeholder-slate-600 pr-10" placeholder="******">
                    
                    <button type="button" onclick="toggleSenha('confirmaInput')" class="absolute right-3 top-3 text-slate-500 hover:text-white transition" title="Ver senha">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </button>
                </div>
            </div>

            <button type="submit" id="btnSubmit" class="w-full bg-gradient-to-r from-amber-500 to-orange-600 text-white font-bold py-3 rounded-lg hover:brightness-110 active:scale-95 transition shadow-lg mt-4 tracking-wide">
                ENTRAR
            </button>
        </form>

        <div class="mt-8 text-center pt-4 border-t border-slate-700/50">
            <button type="button" onclick="toggleMode()" class="text-sm text-slate-400 hover:text-white transition group">
                <span id="linkText">Não tem conta? <span class="text-amber-400 group-hover:underline">Cadastre-se grátis</span>.</span>
            </button>
        </div>

    </div>

    <script>
        let isRegister = false;
        
        function toggleSenha(idCampo) {
            const campo = document.getElementById(idCampo);
            campo.type = (campo.type === "password") ? "text" : "password";
        }

        function toggleMode() {
            isRegister = !isRegister;
            
            const fields = document.getElementById('cadastroFields');
            const confirmField = document.getElementById('confirmField');
            const btn = document.getElementById('btnSubmit');
            const link = document.getElementById('linkText');
            const acao = document.getElementById('acaoInput');

            if (isRegister) {
                
                fields.classList.remove('hidden');
                confirmField.classList.remove('hidden');
                btn.innerHTML = "CRIAR CONTA 🚀";
                link.innerHTML = 'Já tem conta? <span class="text-amber-400 hover:underline">Faça login</span>.';
                acao.value = "cadastrar";
            } else {
                
                fields.classList.add('hidden');
                confirmField.classList.add('hidden');
                btn.innerHTML = "ENTRAR";
                link.innerHTML = 'Não tem conta? <span class="text-amber-400 hover:underline">Cadastre-se grátis</span>.';
                acao.value = "login";
            }
        }

        
        <?php if (isset($_POST['acao']) && $_POST['acao'] === 'cadastrar'): ?>
            toggleMode(); 
        <?php endif; ?>

    </script>
</body>
</html>