<?php
include '../includes/conexao.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    $categoria = $_POST['categoria'];
    $validade = $_POST['validade'];

    $stmt = $pdo->prepare("INSERT INTO medicamentos (nome, preco, quantidade, categoria, validade) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nome, $preco, $quantidade, $categoria, $validade]);

    header("Location: listar.php");
    exit;
}
?>