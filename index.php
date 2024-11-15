<?php

session_start();
include 'includes/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['user'] = $user;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Usuário ou senha inválidos!";
    }
}

?>
<!-- Formulário de login com Bootstrap -->