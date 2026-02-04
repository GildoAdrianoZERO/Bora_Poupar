<?php
session_set_cookie_params(0);
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: app.php");
    exit;
}

require 'BancoDeDados/conexao_db.php';

$erro = "";
$sucesso = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email']);
    $senha = trim($_POST['password']);
    $acao = $_POST['acao'];

    // --- ROTA DE CADASTRO ---
    if ($acao === 'cadastrar') {
        $nome = trim($_POST['full_name']);
        $meta = (int) $_POST['meta'];


        $confirmarSenha = trim($_POST['confirm_password']);


        if (empty($nome) || empty($email) || empty($senha) || $meta <= 0) {
            $erro = "Preencha todos os campos corretamente.";
        }
        
        elseif ($meta > 100000) {
            $erro = "A meta máxima permitida é de R$ 100.000,00.";
        }
        
        elseif ($senha !== $confirmarSenha) {
            $erro = "As senhas não conferem. Tente novamente.";
        } else {
            // Verifica se e-mail já existe
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);

            if ($stmt->rowCount() > 0) {
                $erro = "Este e-mail já está em uso.";
            } else {

                try {
                    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

                    $sql = "INSERT INTO users (full_name, email, password, meta_alvo) VALUES (?, ?, ?, ?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$nome, $email, $senhaHash, $meta]);

                    $sucesso = "Conta criada! Agora faça login com sua senha.";
                } catch (PDOException $e) {
                    $erro = "Erro interno do servidor";
                }
            }
        }
    }

    // --- ROTA DE LOGIN ---
    elseif ($acao === 'login') {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica se achou o usuário E se a senha bate com o hash
        if ($user && password_verify($senha, $user['password'])) {
            // Cria a sessão
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nome'] = $user['full_name'];
            $_SESSION['meta'] = $user['meta_alvo'];

            header("Location: app.php");
            exit;
        } else {
            $erro = "E-mail ou senha incorretos.";
        }
    }
}
?>