<?php
session_start();
require 'includes/conexao.php';

if (isset($_SESSION['usuario_id'])) {
    header('Location: dashboard.php');
    exit();
}

$erro = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if (!empty($email) && !empty($senha)) {
        $stmt = $pdo->prepare("SELECT id, nome, senha, role FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_role'] = $usuario['role'];

            header('Location: dashboard.php');
            exit();
        } else {
            $erro = "E-mail ou senha inválidos.";
        }
    } else {
        $erro = "Preencha todos os campos.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Farmácia</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-lg">
            <h3 class="text-center mb-4">Login</h3>
            <?php if ($erro): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" name="senha" id="senha" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>
        </div>
    </div>
</body>
</html>