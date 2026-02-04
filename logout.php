<?php
// ARQUIVO: logout.php
// Responsabilidade: Destruir completamente a sessão do usuário.

// 1. Encontra a sessão atual (precisamos iniciá-la para poder matá-la)
session_start();

// 2. Apaga todas as variáveis da memória do servidor
// É como esvaziar os bolsos: $_SESSION['user_id'] deixa de existir.
$_SESSION = array();

// 3. Mata o Cookie do Navegador (A "Limpeza Profunda")
// Se o PHP usou cookies para lembrar da sessão, forçamos o navegador a esquecer.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 4. Destrói a sessão no servidor
session_destroy();

// 5. Redireciona o usuário para a tela de Login
header("Location: index.php");
exit;
?>